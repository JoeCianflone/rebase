<?php

declare(strict_types=1);

namespace App\Actions;

use ReflectionClass;

/**
 * This will turn:
 *      App\Http\Controllers\Dashboard\IndexDashboardController
 * to:
 *      Dashboard/IndexDashboard
 * Makes life easier to find the Inertia file.
 */
class GetView
{
    public static function execute(object $class, string $location = 'app'): string
    {
        $refClass = new ReflectionClass($class);

        $path = 'rebase' === $location ? config('app-paths.views.rebase.pages') : config('app-paths.views.app.pages');

        return $path.str_replace(ucfirst(config('app-paths.controllers')), '', str_replace('\\', '/', $refClass->name));
    }
}
