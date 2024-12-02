<?php

namespace App\Http\Controllers;

use App\Models\CarrierService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\ScopeTrait;

class CarrierServiceController extends Controller
{
    use ScopeTrait;

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'source_country_code' => 'required|string|exists:countries,code',
            'destination_country_code' => 'required|string|exists:countries,code'
        ]);

        $scope = $this->determineScope($validated['source_country_code'], $validated['destination_country_code']);

        $carrierServices = CarrierService::whereHas('pricing', function ($query) use ($scope) {
            $query->where('scope', $scope);
        })->get(['id', 'name']);

        return response()->json($carrierServices);
    }
}
