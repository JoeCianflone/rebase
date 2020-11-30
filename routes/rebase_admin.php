<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->domain('my.rebase.test')->namespace('Rebase\Admin')->group(function (): void {
    Route::get('{customerId}/settings', Customers\Settings::class)->name('customer.settings');
    Route::post('{customerId}/settings/update/{type}', Customers\CustomerUpdate::class)->name('customer.update');
    Route::get('{customerID}/settings/invoice/{invoiceID}', Customers\ShowInvoice::class)->name('customer.show.invoice');

    Route::get('{customerID}/switch', Pick::class)->name('switch');
    // Route::get('{customerID}/workspaces/{workspaceID}/edit', '')->name('customer.workspaces.edit');
    Route::post('{customerID}/workspaces/{workspaceID}/archive', Workspaces\WorkspaceArchive::class)->name('customer.workspaces.archive');
});
