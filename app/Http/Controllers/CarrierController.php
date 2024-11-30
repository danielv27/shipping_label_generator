<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use Illuminate\Http\JsonResponse;

class CarrierController extends Controller
{
    public function index(): JsonResponse
    {
        $carriers = Carrier::query()
            ->select(['id', 'name'])
            ->get();
        return response()->json($carriers);
    }
}
