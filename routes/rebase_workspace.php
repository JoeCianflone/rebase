<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Rebase\Workspace')->middleware(['workspace.connection'])->group(function (): void {
    Route::namespace('Validate')->group(function (): void {
        Route::get('/validate/workspace/{token}', ValidateWorkspaceToken::class)->name('validate.workspace');
        Route::inertia('/validate/complete', 'rebase.workspace.validate.validateComplete')->name('validate.workspace.complete');
        Route::inertia('/validate/token-expired', 'rebase.workspace.validate.validateTokenExpired')->name('validate.workspace.token-expired');
        Route::post('/validate/workspace/{token}', ProcessValidateWorkspace::class)->name('validate.workspace.process');
    });

    Route::namespace('Auth')->group(function (): void {
        Route::get('/login', Login::class)->name('login');
        Route::post('/login', ProcessLogin::class)->name('login.process');
        Route::get('/logout', ProcessLogout::class)->name('logout');
    });

    Route::middleware(['auth', 'onboarded', 'workspace.access'])->group(function (): void {
        Route::get('/dashboard', Dashboard\Dashboard::class)->name('dashboard');
        Route::get('/dashboard/choice', Dashboard\ChooseWorkspace::class)->name('choose.workspace');
    });

    Route::middleware(['auth'])->group(function (): void {
        Route::get('/onboarding/start', Onboarding\OnboardingStart::class)->name('onboarding.start');
        Route::get('/onboarding/complete', Onboarding\OnboardingComplete::class)->name('onboarding.complete');
    });
});
