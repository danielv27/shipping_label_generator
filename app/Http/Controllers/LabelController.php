<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Label;
use App\Models\CarrierService;
use App\Models\Country;
use Barryvdh\DomPDF\Facade\Pdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

class LabelController extends Controller
{
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'recipient_name' => 'required|string',
            'recipient_street' => 'required|string',
            'recipient_postal_code' => 'required|string',
            'recipient_city' => 'required|string',
            'recipient_country' => 'required|exists:countries,code',
            'carrier_service_id' => 'required|exists:carrier_services,id',
        ]);

        $label = Label::create([
            'recipient_name' => $validated['recipient_name'],
            'recipient_street' => $validated['recipient_street'],
            'recipient_postal_code' => $validated['recipient_postal_code'],
            'recipient_city' => $validated['recipient_city'],
            'recipient_country' => $validated['recipient_country'],
            'carrier_service_id' => $validated['carrier_service_id'],
        ]);

        $carrierService = CarrierService::find($validated['carrier_service_id']);
        $recipientCountry = Country::where('code', $validated['recipient_country'])->first();

        $barcode = $this->generateBarcode();

        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = base64_encode($generator->getBarcode($barcode, $generator::TYPE_CODE_128));

        $data = [
            'recipient' => [
                'name' => $label->recipient_name,
                'street' => $label->recipient_street,
                'postal_code' => $label->recipient_postal_code,
                'city' => $label->recipient_city,
                'country' => $recipientCountry->name,
            ],
            'carrier_service_name' => $carrierService->name,
            'barcode' => $barcode,
            'barcode_image' => $barcodeImage,
        ];

        $pdf = Pdf::loadView('pdf.label', $data);
        return $pdf->download('shipping-label.pdf');
    }


    private function generateBarcode(): string
    {
        $lastLabel = Label::latest('id')->first();

        $lastNumber = $lastLabel ? $lastLabel->id : 0;
        $nextNumber = $lastNumber + 1;

        return 'MP' . str_pad($nextNumber, 8, '0', STR_PAD_LEFT);
    }
}
