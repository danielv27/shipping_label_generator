<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function generateLabel(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric|min:0.1',
            'carrier_service_id' => 'required|exists:carrier_services,id',
        ]);
        return response()->json(['message' => 'bla']);
    }
}
