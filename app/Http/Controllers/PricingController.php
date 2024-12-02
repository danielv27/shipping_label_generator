<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\Pricing;
use App\Traits\ScopeTrait;

class PricingController extends Controller
{
    use ScopeTrait;

    public function show($carrierServiceId): JsonResponse
    {
        // Retrieve pricing entries for the given carrier service ID
        $pricing = Pricing::where('carrier_service_id', $carrierServiceId)->get();

        // Check if pricing exists
        if ($pricing->isEmpty()) {
            return response()->json(['error' => 'No pricing found for the specified carrier service.'], 404);
        }

        // Return the pricing data
        return response()->json($pricing);
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'carrier_service_id' => 'required|exists:carrier_services,id',
            'weight' => 'required|numeric|min:0',
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
