<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\Pricing;
use App\Traits\ScopeTrait;

class PricingController extends Controller
{
    use ScopeTrait;

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'carrier_service_id' => 'required|exists:carrier_services,id',
            'weight' => 'required|numeric|gt:0',
            'sender_country_code' => 'required|exists:countries,code',
            'recipient_country_code' => 'required|exists:countries,code',
        ]);

        $scope = $this->determineScope($validated['sender_country_code'], $validated['recipient_country_code']);

        $pricing = Pricing::where('carrier_service_id', $validated['carrier_service_id'])
            ->where('scope', $scope)
            ->where('min_weight', '<=', $validated['weight'])
            ->where(function ($query) use ($validated) {
                $query->where('max_weight', '>=', $validated['weight'])
                    ->orWhereNull('max_weight'); // max_weight is NULL for no upper bound
            })
            ->first();

        if (!$pricing) {
            return response()->json(['error' => 'No pricing available for the provided criteria.'], 404);
        }

        return response()->json(['price' => $pricing->price]);
    }
}
