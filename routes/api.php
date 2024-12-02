<?php

use App\Http\Controllers\CarrierServiceController;
use App\Http\Controllers\LabelController;
use App\Models\CarrierService;
use App\Models\Country;
use App\Http\Controllers\PricingController;
use Illuminate\Support\Facades\Route;

Route::get('countries', fn () => response()->json(Country::all(['name', 'code'])))->name('countries.index');

Route::get('carrier-services', [CarrierServiceController::class, 'index'])->name('carrier-services.index');

Route::post('pricing/calculate', [PricingController::class, 'calculate'])->name('pricing.calculate');

Route::post('label/generate', [LabelController::class, 'generate'])->name('label.generate');
