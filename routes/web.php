<?php

use Illuminate\Support\Facades\Route;

/**
 *
 * web
 * -----------------------------
 * routes that are web are non-authorized, meaning, routes that do not need any form of system auth to
 * view. These routes include registration, searching for workspaces and some various
 * legal pages that are global for all customers.
 *
 * GET rebase.test/get-started --> redirect()
 * GET rebase.test/register  --> redirect()
 *
 * GET /register/check-workspace --> Register\WorkspaceAvailability::class
 * POST /register/workspace-availability -->Register\WorkspaceAvaila::
 *
 * GET /register/customer?workspace=xyz
 * POST /register/customer
 *
 * GET /register/next-steps
 *
 *
 * rebase.test/register
 * rebase.test/register?slug=
 * rebase.test/register/process
 * rebase.test/register/thank-you
 *
 * rebase.test/find
 * rebase.test/find/process
 * rebase.test/find/results
 *
 * rebase.test/login
 *
 * rebase.test/legal
 * rebase.test/privacy
 * rebase.test/contact
 */


Route::domain(config('app.url'))->group(function (): void {
    // Route::get('/design', Design\ViewDesign::class)->name('design')->middleware('only.local');

    Route::inertia(['url' => 'register/check-workspace', 'namespace' => 'Web'])->name('check-workspace.index');
    Route::post('register/check-workspace', Web\Register\ProcessCheckWorkspace::class)->name('check-workspace.process');

    Route::get('register/customer',  Web\Register\CustomerInfo::class)->name('register.index');
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
