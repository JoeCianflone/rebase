<?php

use Illuminate\Support\Facades\Route;

$domain = config('rebase.subdomains.admin').'.'.config('app.domain');

Route::domain($domain)->prefix('{customerID}')->namespace('Rebase\Admin')->group(function (): void {
    // Validate member email address
    Route::get('member/{memberID}/validate/{token}', Members\MemberValidate::class)->name('member.validate');
    Route::post('member/{memberID}/validate/{token}', Members\MemberVerify::class)->name('member.verify');

    Route::middleware(['auth'])->group(function (): void {
        // Pick a Sub-Domain
        Route::get('pick', Pick::class)->name('pick');

        // Customer
        Route::get('customer', Customers\CustomerIndex::class)->name('customer.index');

        // Workspace

        // Member
    });
});
