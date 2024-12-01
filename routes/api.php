<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('carrier-services', [CarrierServiceController::class, 'index'])->name('carrier-services.index');

Route::get('pricing/{carrierServiceId}', [PricingController::class, 'show'])->name('pricing.show');
Route::post('pricing/calculate', [PricingController::class, 'calculate'])->name('pricing.calculate');

Route::post('shipping/generate-label', [ShippingController::class, 'generateLabel'])->name('shipping.generate-label');
