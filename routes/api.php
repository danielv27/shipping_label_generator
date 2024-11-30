<?php

use App\Http\Controllers\CarrierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingController;


Route::get('carriers', [CarrierController::class, 'index']);

Route::post('/get-price', [ShippingController::class, 'getPrice']);
Route::post('/generate-label', [ShippingController::class, 'generateLabel']);
