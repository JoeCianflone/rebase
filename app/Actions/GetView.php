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

        $path = 'shared' === $location ? config('app-paths.view_shared_pages') : config('app-paths.view_app_pages');

        return $path.str_replace(ucfirst(config('app-paths.controllers')), '', str_replace('\\', '/', $refClass->name));
    }
}
