<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['workspace.status'])->group(callback: function (): void {
    // Login redirects to global signin page...see rebase_auth for routes...
    Route::get('login', fn (Request $request) => redirect()->route(route: 'signin', parameters: ['to' => $request->get(key: 'sub')]));

    Route::middleware(['auth'])->group(callback: function (): void {
        Route::get('/dashboard', Rebase\Workspace\Dashboard\Dashboard::class)->name('dashboard');

        Route::get('/onboarding/hold',      Rebase\Workspace\Onboarding\OnboardingHold::class)->name('onboarding.hold');
        Route::get('/onboarding/start',     Rebase\Workspace\Onboarding\OnboardingStart::class)->name('onboarding.start');
        Route::post('/onboarding/complete', Rebase\Workspace\Onboarding\OnboardingComplete::class)->name('onboarding.complete');

        Route::get('/members', Rebase\Workspace\Members\WorkspaceMemberIndex::class)->name('workspace-members.index');
    });
});
