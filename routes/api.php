<?php

use App\Http\Controllers\CarrierServiceController;
use App\Models\CarrierService;
use App\Models\Country;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ShippingController;
use Illuminate\Support\Facades\Route;

Route::get('countries', fn () => response()->json(Country::all(['name', 'code'])))->name('countries.index');

Route::get('carrier-services', [CarrierServiceController::class, 'index'])->name('carrier-services.index');

Route::get('pricing/{carrierServiceId}', [PricingController::class, 'show'])->name('pricing.show');
Route::post('pricing/calculate', [PricingController::class, 'calculate'])->name('pricing.calculate');

Route::post('shipping/generate-label', [ShippingController::class, 'generateLabel'])->name('shipping.generate-label');
