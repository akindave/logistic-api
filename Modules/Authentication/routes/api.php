<?php

use Illuminate\Support\Facades\Route;
use Modules\Authentication\Http\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::post('register','register')->name('register');
    Route::post('login','login')->name('login');
    Route::middleware(['auth:sanctum'])->group(function(){
        Route::post('logout','logout')->name('logout');
    });
});
