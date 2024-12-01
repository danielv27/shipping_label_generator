<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\Pricing;

class PricingController extends Controller
{

    public function show($carrierServiceId): JsonResponse
    {
        // Retrieve pricing entries for the given carrier service ID
        $pricing = Pricing::where('carrier_service_id', $carrierServiceId)->get();

        // Check if pricing exists
        if ($pricing->isEmpty()) {
            return response()->json(['error' => 'No pricing found for the specified carrier service.'], 404);
        }

        // Return the pricing data
        return response()->json($pricing, 200);
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'carrier_service_id' => 'required|exists:carrier_services,id',
            'weight' => 'required|numeric|min:0',
            'sender_country' => 'required|string',
            'receiver_country' => 'required|string',
        ]);
    
        $scope = $this->determineScope($validated['sender_country'], $validated['receiver_country']);
    
        $pricing = Pricing::where('carrier_service_id', $validated['carrier_service_id'])
            ->where('scope', $scope)
            ->where('min_weight', '<=', $validated['weight'])
            ->where('max_weight', '>=', $validated['weight'])
            ->first();
    
        if (!$pricing) {
            return response()->json(['error' => 'No pricing available for the provided criteria.'], 404);
        }
    
        return response()->json(['price' => $pricing->price], 200);
    }
    
    private function determineScope(string $senderCountry, string $receiverCountry): string
    {
        $domesticCountry = 'Netherlands';
        if (strtolower($senderCountry) === strtolower($domesticCountry) &&
            strtolower($receiverCountry) === strtolower($domesticCountry)) {
            return 'domestic';
        }
    
        return 'international';
    }
    

}
