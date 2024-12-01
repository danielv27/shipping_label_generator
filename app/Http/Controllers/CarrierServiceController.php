<?php

namespace App\Http\Controllers;

use App\Models\CarrierService;
use Illuminate\Http\JsonResponse;

class CarrierServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $carriers = CarrierService::query()
            ->select(['id', 'name'])
            ->get();
        return response()->json($carriers);
    }
}