<?php

use App\Domain\Services\Blacklists\Controllers\IndexBlacklistController;

Route::get('admin/blacklist',               IndexBlacklistController::class);
Route::get('admin/blacklist/create',        CreateBlacklistController::class);
Route::post('admin/blacklist',              StoreBlacklistController::class);
Route::get('admin/blacklist/{slug}',        ShowBlacklistController::class);
Route::get('admin/blacklist/{slug}/edit',   EditBlacklistController::class);
Route::patch('admin/blacklist/{slug}',      UpdateBlacklistController::class);
Route::delete('admin/blacklist/{slug}',     DeleteBlacklistController::class);
