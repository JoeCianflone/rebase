<?php

use Illuminate\Support\Facades\Route;

Route::get('/registration', fn () => redirect()->route('register.index'));
Route::get('/signup', fn () => redirect()->route('register.index'));
Route::get('/sign-up', fn () => redirect()->route('register.index'));

Route::namespace('Rebase\Guest')->domain(config('app.domain'))->group(function (): void {
    // Legal
    Route::get('legal/privacy', Legal\Privacy::class)->name('privacy');
    Route::get('legal/terms', Legal\Terms::class)->name('terms');

    // Registration
    Route::get('register', Registers\RegisterIndex::class)->name('register.index');
    Route::post('register', Registers\RegisterCheckSlug::class)->name('register.check.slug');
    Route::get('register/email', Registers\RegisterEmail::class)->name('register.email');
    Route::post('register/email', Registers\RegisterCheckEmail::class)->name('register.check.email');
    Route::get('register/customer', Registers\RegisterCustomer::class)->name('register.customer');
    Route::post('register/customer', Registers\RegisterStore::class)->name('register.store');
    Route::get('register/complete', Registers\RegisterComplete::class)->name('register.complete');

    // Search
    Route::get('search', CustomerSearch\SearchIndex::class)->name('search.index');
    Route::post('search', CustomerSearch\SearchProcess::class)->name('search.process');
    Route::get('search/results', CustomerSearch\SearchResults::class)->name('search.show');
});
