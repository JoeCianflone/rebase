<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['workspace.connection', 'workspace.status'])->namespace('Rebase\Workspace')->group(function (): void {
    Route::namespace('Validate')->group(function (): void {
        Route::inertia('/validate/complete', 'rebase.workspace.validate.validateComplete')->name('validate.workspace.complete');
        Route::inertia('/validate/token-expired', 'rebase.workspace.validate.validateTokenExpired')->name('validate.workspace.token-expired');

        Route::get('/validate/workspace/{token}', ValidateWorkspaceToken::class)->name('validate.workspace');
        Route::post('/validate/workspace/{token}', ProcessValidateWorkspace::class)->name('validate.workspace.process');
    });

    Route::namespace('Auth')->group(function (): void {
        Route::get('login', Login::class)->name('login');
        Route::post('login', ProcessLogin::class)->name('login.process');
        Route::get('logout', ProcessLogout::class)->name('logout');
    });

    Route::namespace('ForgotPassword')->group(function (): void {
        Route::get('/forgot-password', Forgot::class)->name('password.request');
        Route::post('/forgot-password', ProcessForgot::class)->name('password.email');
        Route::get('/reset-password/{token}', Reset::class)->name('password.reset');
        Route::post('/reset-password', ProcessReset::class)->name('password.update');
    });

    Route::middleware(['auth', 'workspace.access', 'guest'])->group(function (): void {
        Route::get('/dashboard', Dashboard\Dashboard::class)->name('dashboard');
        Route::get('/dashboard/choice', Dashboard\ChooseWorkspace::class)->name('choose.workspace');

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
