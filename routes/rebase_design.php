<?php

use Illuminate\Support\Facades\Route;

Route::inertia('design/', 'Rebase\Design\Home')->name('design.home');
Route::inertia('design/colors', 'Rebase\Design\Colors')->name('design.colors');
Route::inertia('design/layout', 'Rebase\Design\Layout')->name('design.layout');
Route::inertia('design/spacing', 'Rebase\Design\Spacing')->name('design.spacing');
