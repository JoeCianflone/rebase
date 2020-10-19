<?php

use Illuminate\Support\Facades\Route;

/**
 *  * workspace
 * -----------------------------
 * These routes require a member to be authorized to view.
 *
 * space.rebase.test/login
 * space.rebase.test/logout
 * space.rebase.test/dashboard
 * space.rebase.test/onboarding
 * space.rebase.test/onboarding/{i}
 * space.rebase.test/onboarding/complete
 * space.rebase.test/customers
 * space.rebase.test/members
 * space.rebase.test/members/{id}
 * space.rebase.test
 */
Route::middleware(['workspace.connection'])->group(function (): void {
    Route::namespace('Rebase\Workspace\Auth')->group(function (): void {
        Route::get('/login', Login::class)->name('login');
        Route::get('/verify/{token}', VerifyCustomer::class)->name('verify');
    });

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

    /*
         * GET /reports
         * GET /reports/accounts/closed
         * GET /reports/accounts/new
         * GET /reports/accounts/breakdown
         * GET /reports/accounts/unpaid
         * GET /reports/accounts/declined-payment
         *
         * GET /customers/accounts
         * GET /customers/workspaces
         * GET /customers/accounts/{accountID}
         *
         * GET /customers/notification
         *
         */
});
