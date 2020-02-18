<?php

use Illuminate\Support\Facades\Route;


Route::get('/', Dashboard\IndexDashboardController::class);
Route::post('/', Dashboard\IndexDashboardController::class);
