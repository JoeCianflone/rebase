<?php

use Illuminate\Support\Facades\Route;

// Route::redirect('/login', '/find');
Route::namespace('Open')->group(function (): void {
    /*
     * What happens when a user doesn't know their slug? If they go to the site
     * and just try to go to /login, we will redirect them to /find and they
     * can then search for their site.
     */

    Route::prefix('find')->group(function (): void {
        /*
         * GET /find
         * POST /find
         * GET /find/results
         */

        Route::get('/', Find\ViewFind::class)->name('view.find');
        Route::post('/', Find\ProcessFind::class)->name('process.find');
        Route::get('/results', Find\ViewResults::class)->name('view.find.results');
    });

    Route::prefix('registration')->group(function (): void {
        /*
         * GET /registration
         * POST /registration
         */

        Route::get('/', Registration\ViewRegistration::class)->name('view.registration');
        Route::post('/', Registration\StoreRegistration::class)->name('store.registration');
    });

    // Route::prefix('legal')->name('legal.')->group(function (): void {
//     /*
//      * GET /legal/privacy
//      * GET /legal/terms
//      */
// });
});
