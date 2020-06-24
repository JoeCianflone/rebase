<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Workspace')->middleware(['workspace.connection'])->group(function (): void {
    /*
     * GET /forgot/password
     * POST /forgot/password
     *
     * GET  /forgot/reset/{token}
     * POST /forgot/reset/{token}
     *
     * GET  /password/confirm
     * POST /password/confirm
     *
     * GET  /login
     * POST /login
     *
     * GET /logout
     *
     * GET /welcome/{slide}?
     * POST /welcome/complete
     *
     * GET /dashboard
     *
     * GET /account
     * GET /account/edit
     * PUT /account
     *
     * GET  /account/credit-card
     * POST /account/credit-card
     *
     * GET /account/invoices
     *
     * GET /account/plan
     * PUT /account/plan
     */

    Route::get('/login', Auth\ViewLogin::class)->name('view.login');
});
