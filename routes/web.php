<?php

Route::middleware(['web'])->group(function() {

    /**
     * Routes to the dasboard
     */
    Route::namespace('App\Domain\Services\Dashboard\Controllers')->group(function() {
        Route::get('/dashboard', IndexDashboardController::class);
    });

});
