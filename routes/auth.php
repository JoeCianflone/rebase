<?php

use Illuminate\Support\Facades\Route;

Route::domain('auth.'.config('app.domain'))->group(function (): void {
    Route::get('signin', Rebase\Auth\Login::class)->name('signin');

    Route::post('login', Rebase\Auth\ProcessLogin::class)->name('login.process');
    Route::get('logout', Rebase\Auth\ProcessLogout::class)->name('logout');

    Route::get('forgot-password',           Rebase\Auth\ForgotPassword\Forgot::class)->name('password.request');
    Route::post('forgot-password',          Rebase\Auth\ForgotPassword\ProcessForgot::class)->name('password.email');
    Route::get('reset-password/{token}',    Rebase\Auth\ForgotPassword\Reset::class)->name('password.reset');
    Route::post('reset-password',           Rebase\Auth\ForgotPassword\ProcessReset::class)->name('password.update');
});
