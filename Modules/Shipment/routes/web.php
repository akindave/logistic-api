<?php

use Illuminate\Support\Facades\Route;
use Modules\Shipment\Http\Controllers\ShipmentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('shipments', ShipmentController::class)->names('shipment');
});
