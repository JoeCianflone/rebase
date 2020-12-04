<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['workspace.status'])->namespace('Rebase\Workspace')->group(function (): void {
    // Login redirects to global signin page...see rebase_auth for routes...
    Route::get('login', fn (Request $request) => redirect()->route('signin', ['to' => $request->get('slug')]));

    Route::middleware(['auth'])->group(function (): void {
        Route::get('/dashboard', Dashboard\Dashboard::class)->name('dashboard');

        Route::get('/onboarding/start', Onboarding\OnboardingStart::class)->name('onboarding.start');
        Route::get('/onboarding/hold', Onboarding\OnboardingHold::class)->name('onboarding.hold');
        Route::post('/onboarding/complete', Onboarding\OnboardingComplete::class)->name('onboarding.complete');

        // Route::get('/customer/settings', Customer\Settings::class)->name('customer.settings');

        Route::get('/members', Members\Members::class)->name('members');
        // Route::get('/members', Members\Members::class)->name('members');
        // Route::get('/customer/settings/workspace/{id}/edit', Customer\WorkspaceSettings::class)->name('customer.edit.workspace');
        // Route::delete('/customer/settings/workspace/{id}', Customer\WorkspaceDelete::class)->name('customer.delete.workspace');
    });
});
