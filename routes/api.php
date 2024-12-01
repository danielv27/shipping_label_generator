<?php

use App\Http\Controllers\CarrierServiceController;
use App\Http\Controllers\ServicePricingController;
use App\Http\Controllers\ShippingController;
use Illuminate\Support\Facades\Route;

Route::get('carrier-services', [CarrierServiceController::class, 'index'])->name('carrier-services.index');

Route::get('pricing/{carrierServiceId}', [ServicePricingController::class, 'show'])->name('pricing.show');
Route::post('pricing/{carrierServiceId}/calculate', [ServicePricingController::class, 'calculate'])->name('pricing.calculate');

Route::post('shipping/generate-label', [ShippingController::class, 'generateLabel'])->name('shipping.generate-label');
