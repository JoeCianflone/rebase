<?php

use Illuminate\Support\Facades\Route;

$domain = config('paths.subdomains.admin').'.'.config('app.domain');

Route::domain($domain)->prefix('{customerID}')->group(function (): void {
    // Validate member email address
    Route::get('member/{memberID}/validate/{token}',    Rebase\Admin\Members\MemberValidate::class)->name('member.validate');
    Route::post('member/{memberID}/validate/{token}',   Rebase\Admin\Members\MemberVerify::class)->name('member.verify');

    Route::middleware(['auth'])->group(function (): void {
        // Pick a Sub-Domain
        Route::get('pick', Rebase\Admin\Pick::class)->name('pick');

        // Customer
        Route::get('customer',              Rebase\Admin\Customers\CustomerIndex::class)->name('customer.index');
        Route::get('invoice/{invoiceID}',   Rebase\Admin\Customers\ShowInvoice::class)->name('customer.invoice.show');

        // Workspace
        Route::get('workspaces', Rebase\Admin\Workspaces\WorkspaceIndex::class)->name('workspace.index');

        // Member
        Route::get('members', Rebase\Admin\Members\MemberIndex::class)->name('member.index');
    });
});
