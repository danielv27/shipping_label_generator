<?php

namespace App\Http\Controllers;

use App\Models\CarrierService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CarrierServiceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'source_country_code' => 'required|string|exists:countries,code',
            'destination_country_code' => 'required|string|exists:countries,code'
        ]);

        $domesticCountryCode = 'NL';
        $scope = ['international'];

        if (
            $validated['source_country_code'] == $domesticCountryCode
            && $validated['destination_country_code'] == $domesticCountryCode
        ) {
            $scope = ['domestic', 'international'];
        }

        $carrierServices = CarrierService::whereHas('pricing', function ($query) use ($scope) {
            $query->whereIn('scope', $scope);
        })->get(['id', 'name']);

        return response()->json($carrierServices);
    }
}
