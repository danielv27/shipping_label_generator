<?php

use App\Http\Controllers\CarrierServiceController;
use App\Http\Controllers\ServicePricingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingController;

Route::get('carrier-services', [CarrierServiceController::class, 'index']);
Route::get('service-pricings', [ServicePricingController::class, 'index']);
 

Route::post('/get-price', [ShippingController::class, 'getPrice']);
Route::post('/generate-label', [ShippingController::class, 'generateLabel']);
