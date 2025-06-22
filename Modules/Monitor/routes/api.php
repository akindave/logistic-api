<?php

use Illuminate\Support\Facades\Route;
use Modules\Monitor\Http\Controllers\MonitorController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logs',[MonitorController::class,'index']);
});
