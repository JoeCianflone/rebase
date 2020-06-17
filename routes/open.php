<?php

use Illuminate\Support\Facades\Route;

Route::domain(config('app.url'))->namespace('Open')->group(function (): void {
    /*
     * GET  /find
     * POST /find
     * GET  /find/results
     *
     * GET  /registration
     * POST /registration
     *
     * // These are kinda my thinking on where routes like this could go
     * // I'm not 100% sure I like it, but since legal crap is really
     * // part of the application and not marketing, it makes sense
     * // for it to live in the application, at least thats what
     * // I think for now, that could change.
     * GET /legal/privacy
     * GET /legal/terms-and-conditions
     */

    /*
     * When a user doesn't know where to go to log in they will go to our domain/login.
     * While this is incorrect, we don't want to just give them a 404 or something
     * we want to help guide them to the right place. The /find route is our
     * search page that will allow them to search for their correct login.
     */
    Route::get('/login', function () {
        return redirect()->route('view.registration');
    });

    Route::get('/find', Find\ViewFind::class)->name('view.find');
    Route::post('/find', Find\ProcessFind::class)->name('process.find');
    Route::get('/find/results', Find\ViewResults::class)->name('view.results');

    Route::get('/registration', Registration\ViewRegistration::class)->name('view.registration');
    Route::post('/registration', Registration\StoreRegistration::class)->name('store.registration');
});
