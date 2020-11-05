<?php

use Illuminate\Support\Facades\Route;

Route::inertia('legal/privacy', 'rebase.web.legal.privacy')->name('legal.privacy');
Route::inertia('legal/terms', 'rebase.web.legal.terms')->name('legal.terms');

Route::inertia('register', 'rebase.web.register.registerIndex')->name('register.index');

Route::post('register', Rebase\Web\Register\RegisterWorkspaceProcess::class)->name('register.workspace.process');
Route::get('register/customer', Rebase\Web\Register\RegisterCustomer::class)->name('register.customer');
Route::post('register/customer', Rebase\Web\Register\RegisterStore::class)->name('register.store');

Route::inertia('register/complete', 'rebase.web.register.registerComplete')->name('register.complete');

Route::get('/registration', fn () => redirect()->route('register.index'));
Route::get('/signup', fn () => redirect()->route('register.index'));
Route::get('/sign-up', fn () => redirect()->route('register.index'));

// Route::get('/find', Find::class);
// Route::post('/find/process', ProcessFind::class)->name('process.find');
// Route::get('/find/results', ShowFind::class)->name('show.find');

// Route::get('/login', fn () => redirect()->url('/find'));
