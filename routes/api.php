<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingController;


Route::post('/calculate-price', [ShippingController::class, 'calculatePrice']);
Route::post('/generate-label', [ShippingController::class, 'generateLabel']);
