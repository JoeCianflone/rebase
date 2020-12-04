<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Rebase\Auth')->domain('auth.'.config('app.domain'))->group(function (): void {
    Route::get('signin', Login::class)->name('signin');

    Route::post('login', ProcessLogin::class)->name('login.process');
    Route::get('logout', ProcessLogout::class)->name('logout');

    Route::get('forgot-password', ForgotPassword\Forgot::class)->name('password.request');
    Route::post('forgot-password', ForgotPassword\ProcessForgot::class)->name('password.email');
    Route::get('reset-password/{token}', ForgotPassword\Reset::class)->name('password.reset');
    Route::post('reset-password', ForgotPassword\ProcessReset::class)->name('password.update');
});
