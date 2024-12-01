<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
class ServicePricingController extends Controller
{

    public function show(): JsonResponse
    {
        return response()->json(['message' => 'bla']);
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric|min:0.1',
            'service_id' => 'required|exists:carrier_services,id',
        ], [
            'service_id.exists' => 'The selected service does not exist.'
        ]);
        return response()->json(['message' => 'bla']);
    }

}
