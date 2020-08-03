<?php

use Illuminate\Support\Facades\Route;

/*
 * GET  /get-started
 *
 * GET  /login --> /find
 * GET  /find
 * POST /find
 * GET  /find/results
 *
 * GET  /register --> /registration
 * GET  /registration
 * POST /registration
 *
 * GET /legal/privacy
 * GET /legal/terms-and-conditions
 */
Route::domain(config('app.url'))->namespace('Shared')->group(function (): void {
    Route::get('/design', Design\ViewDesign::class)->name('view.design')->middleware('only.local');

    Route::get('legal/privacy', Legal\ViewPrivacy::class)->name('view.privacy');
    Route::get('legal/terms', Legal\ViewTerms::class)->name('view.terms');

    /*
     * I'm jacking this idea from Slack. This is a page that will allow a user to pick between
     * the options of 1) creating a new account or 2) finding a login page. Users don't
     * always know where to go so we should give them hints.
     */
    Route::get('/get-started', ViewGetStarted::class)->name('view.get-started');

    /*
     * When a user doesn't know where to go to log in they will go to our domain/login.
     * While this is incorrect, we don't want to just give them a 404 or something
     * we want to help guide them to the right place. The /find route is our
     * search page that will allow them to search for their correct login.
     */
    Route::get('/login', function () {
        return redirect()->route('view.find');
    });

    Route::get('/find', Find\ViewFind::class)->name('view.find');
    Route::post('/find', Find\ProcessFind::class)->name('process.find');
    Route::get('/find/results', Find\ViewResults::class)->name('view.results');

    Route::get('/register', function () {
        return redirect()->route('view.registration');
    });

    Route::get('/registration', Registration\ViewRegistration::class)->name('view.registration');
    Route::post('/registration', Registration\StoreRegistration::class)->name('store.registration');
});
