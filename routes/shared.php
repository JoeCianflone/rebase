<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Shared')->middleware(['workspace.connection'])->group(function (): void {
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
