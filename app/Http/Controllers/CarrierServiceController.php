<?php

namespace App\Http\Controllers;

use App\Models\CarrierService;
use Illuminate\Http\JsonResponse;

class CarrierServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $carriers = CarrierService::all(['id', 'name']);
        return response()->json($carriers);
    }
}
