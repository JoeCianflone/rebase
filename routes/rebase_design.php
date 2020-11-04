<?php

use Illuminate\Support\Facades\Route;

Route::inertia('design', 'rebase.design.home')->name('design.index');
Route::inertia('design/colors', 'rebase.design.colors')->name('design.colors');
Route::inertia('design/layout', 'rebase.design.layout')->name('design.layout');
Route::inertia('design/spacing', 'rebase.design.spacing')->name('design.spacing');
Route::inertia('design/components/button', 'rebase.design.components.button')->name('design.button');
