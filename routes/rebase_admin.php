<?php

use Illuminate\Support\Facades\Route;

$domain = config('rebase-paths.admin_subdomain').'.'.config('app.domain');

Route::middleware(['auth'])->domain($domain)->prefix('{customerID}')->namespace('Rebase\Admin')->group(function (): void {
    // Pick a Sub-Domain
    Route::get('pick', Pick::class)->name('pick');

    // Customer
    Route::get('customer', Customers\CustomerIndex::class)->name('customer.index');
    // Route::post('customer/update/{type}', Customers\CustomerUpdate::class)->name('customer.update');
    // Route::get('customer/invoices/{invoiceID}', Customers\ShowInvoice::class)->name('customer.invoice.show');

    // Workspaces
    // Route::get('workspaces/{workspaceID}/edit', '')->name('customer.workspaces.edit');
    // Route::post('workspaces/{workspaceID}/archive', Workspaces\WorkspaceArchive::class)->name('customer.workspaces.archive');

    // Members
});
