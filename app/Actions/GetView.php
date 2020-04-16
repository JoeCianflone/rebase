<?php declare(strict_types=1);

namespace App\Actions;

use ReflectionClass;

/**
 * This will turn:
 *      App\Http\Controllers\Dashboard\IndexDashboardController
 * to:
 *      IndexDashboard
 * Makes life easier to find the Inertia file
 */

class GetView
{
    const SERVICES_PATH     = "App\\Http\\";
    const CONTROLLER_FOLDER = "Controllers\\";
    const CONTROLLER_SUFFIX = "Controller";

    public static function execute(object $class): string
    {
        $refClass = new ReflectionClass($class);

        return str_replace(
            self::CONTROLLER_SUFFIX,
            '',
            str_replace(
                '\\',
                '/',
                str_replace(
                    self::SERVICES_PATH,
                    '',
                    str_replace(self::CONTROLLER_FOLDER, '', $refClass->name)
                )
            )
        );
    }
}
