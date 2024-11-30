<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShippingController extends Controller
{

    public function getAvailableServices(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric|min:0.1',
            'service_id' => 'required|exists:carrier_services,id',
        ]);
        return response()->json(['message' => 'bla']);
    }

    public function getPrice(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric|min:0.1',
            'service_id' => 'required|exists:carrier_services,id',
        ], [
            'service_id.exists' => 'The selected service does not exist.'
        ]);
        return response()->json(['message' => 'bla']);
    }

    public function generateLabel(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric|min:0.1',
            'service_id' => 'required|exists:carrier_services,id',
        ]);
        return response()->json(['message' => 'bla']);
    }
}
