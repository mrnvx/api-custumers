<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;

Route::apiResource('customers', CustomerController::class);
Route::get('customers/{customer}/orders', [OrderController::class, 'index']);
Route::get('customers/{customer}/orders/{order}', [OrderController::class, 'show']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


