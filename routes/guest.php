<?php

use Illuminate\Support\Facades\Route;

Route::get('/registration', fn () => redirect()->route('register.index'));
Route::get('/signup', fn () => redirect()->route('register.index'));
Route::get('/sign-up', fn () => redirect()->route('register.index'));

Route::domain(config('app.domain'))->group(function (): void {
    // Legal
    Route::get('legal/privacy', Rebase\Guest\Legal\Privacy::class)->name('privacy');
    Route::get('legal/terms',   Rebase\Guest\Legal\Terms::class)->name('terms');

    // Registration
    Route::get('register',              Rebase\Guest\Registers\RegisterIndex::class)->name('register.index');
    Route::post('register',             Rebase\Guest\Registers\RegisterCheckSubdomain::class)->name('register.check.sub');
    Route::get('register/email',        Rebase\Guest\Registers\RegisterEmail::class)->name('register.email');
    Route::post('register/email',       Rebase\Guest\Registers\RegisterCheckEmail::class)->name('register.check.email');
    Route::get('register/customer',     Rebase\Guest\Registers\RegisterCustomer::class)->name('register.customer');
    Route::post('register/customer',    Rebase\Guest\Registers\RegisterStore::class)->name('register.store');
    Route::get('register/complete',     Rebase\Guest\Registers\RegisterComplete::class)->name('register.complete');

    // Search
    Route::get('search',            Rebase\Guest\CustomerSearch\SearchIndex::class)->name('search.index');
    Route::post('search',           Rebase\Guest\CustomerSearch\SearchProcess::class)->name('search.process');
    Route::get('search/results',    Rebase\Guest\CustomerSearch\SearchResults::class)->name('search.show');
});
