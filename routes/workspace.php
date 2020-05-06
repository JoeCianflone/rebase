<?php

use Illuminate\Support\Facades\Route;

Route::get('/workspace', Dashboard\DashboardIndex::class)->name('dashboard.index');

/*
 * These are routes needed for the workspaces.
 *
 * Think: dashboards, login, user pages.
 */
