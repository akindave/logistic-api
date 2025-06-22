<?php

use Illuminate\Support\Facades\Route;
use Modules\Shipment\Http\Controllers\ShipmentController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(ShipmentController::class)->group(function () {
        Route::post('/shipments','store');
        Route::get('/shipments','index');
        Route::patch('/shipments/{shipment}','update');
        Route::get('track/{tracking_number}','trackLogistic');
    });
});
