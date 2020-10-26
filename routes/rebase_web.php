<?php

use Illuminate\Support\Facades\Route;

Route::inertia('legal/privacy', 'Rebase\Web\Legal\Privacy')->name('privacy');
Route::inertia('legal/terms', 'Rebase\Web\Legal\Terms')->name('terms');
Route::inertia('register/check-workspace', 'Rebase\Web\Register\CheckWorkspace')->name('check-workspace.index');
Route::post('register/check-workspace', Rebase\Web\Register\ProcessCheckWorkspace::class)->name('check-workspace.process');

Route::get('register/customer', Rebase\Web\Register\CustomerInfo::class)->name('register.index');
Route::post('register/customer', Rebase\Web\Register\ProcessCustomer::class)->name('register.process');

Route::get('/register', fn () => redirect()->route('check-workspace.index'));
Route::get('/registration', fn () => redirect()->route('check-workspace.index'));

// Route::get('/find', Find::class);
// Route::post('/find/process', ProcessFind::class)->name('process.find');
// Route::get('/find/results', ShowFind::class)->name('show.find');

// Route::get('/login', fn () => redirect()->url('/find'));
