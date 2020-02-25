<?php

use Illuminate\Support\Facades\Route;
use App\Domain\Resources\UserResource;

Route::get('/', Dashboard\IndexDashboardController::class);
Route::post('/', Dashboard\IndexDashboardController::class);


// Route::get(UserResource::link('foo'), Dashboard\IndexDashboardController::class);
