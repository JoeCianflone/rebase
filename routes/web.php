<?php

use Illuminate\Support\Facades\Route;

/**
 * web
 * -----------------------------
 * routes that are web are non-authorized, meaning, routes that do not need any form of system auth to
 * view. These routes include registration, searching for workspaces and some various
 * legal pages that are global for all customers.
 */
Route::domain(config('app.url'))->group(function (): void {
    Route::inertia(['url' => 'design', 'namespace' => 'Web'])->name('design')->middleware('only.local');

    Route::inertia(['url' => 'register/check-workspace', 'namespace' => 'Web'])->name('check-workspace.index');
    Route::post('register/check-workspace', Web\Register\ProcessCheckWorkspace::class)->name('check-workspace.process');

    Route::get('register/customer', Web\Register\CustomerInfo::class)->name('register.index');
    Route::post('register/customer', Web\Register\ProcessCustomer::class)->name('register.process');

    Route::inertia(['url' => 'legal/privacy', 'namespace' => 'Web'])->name('privacy');
    Route::inertia(['url' => 'legal/terms', 'namespace' => 'Web'])->name('terms');

    // Route::get('/find', Find::class);
    // Route::post('/find/process', ProcessFind::class)->name('process.find');
    // Route::get('/find/results', ShowFind::class)->name('show.find');

    // Route::get('/login', fn () => redirect()->url('/find'));
    Route::get('/register', fn () => redirect()->route('check-workspace.index'));
    Route::get('/registration', fn () => redirect()->route('check-workspace.index'));
});
