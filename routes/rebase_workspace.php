<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['workspace.status'])->namespace('Rebase\Workspace')->group(callback: function (): void {
    // Login redirects to global signin page...see rebase_auth for routes...
    Route::get('login', fn (Request $request) => redirect()->route(route: 'signin', parameters: ['to' => $request->get(key: 'slug')]));

    Route::middleware(['auth'])->group(callback: function (): void {
        Route::get('/dashboard', Dashboard\Dashboard::class)->name(name: 'dashboard');

        Route::get('/onboarding/start', Onboarding\OnboardingStart::class)->name(name: 'onboarding.start');
        Route::get('/onboarding/hold', Onboarding\OnboardingHold::class)->name(name: 'onboarding.hold');
        Route::post('/onboarding/complete', Onboarding\OnboardingComplete::class)->name(name: 'onboarding.complete');

        // Route::get('/customer/settings', Customer\Settings::class)->name('customer.settings');

        Route::get('/members', Members\WorkspaceMemberIndex::class)->name(name: 'workspace-members.index');
        // Route::get('/members', Members\Members::class)->name('members');
        // Route::get('/customer/settings/workspace/{id}/edit', Customer\WorkspaceSettings::class)->name('customer.edit.workspace');
        // Route::delete('/customer/settings/workspace/{id}', Customer\WorkspaceDelete::class)->name('customer.delete.workspace');
    });
});
