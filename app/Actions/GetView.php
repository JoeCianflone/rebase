<?php
namespace App\Actions;

use ReflectionClass;

/**
 * This assumes you follow the SAME pattern for placement of
 * vue files as you do Services. Follow this formula and
 * everything should just work:
 *
 * Controller:  app/Domain/Services/<ServiceName>/Controllers/Index<ServiceName>Controller
 * Vue:         resources/js/Pages/<ServiceName>/Index<Service>
 *
 * Assuming those things match, this will be able to find your vue files and load them
 */
class GetView
{

    const SERVICES_PATH     = "App\\Domain\\Services\\";
    const CONTROLLER_FOLDER = "Controllers\\";
    const CONTROLLER_SUFFIX = "Controller";

    public static function execute($class)
    {
        $refClass = new ReflectionClass($class);

        return str_replace(self::CONTROLLER_SUFFIX, '',
                    str_replace('\\', '/',
                        str_replace(self::SERVICES_PATH, '',
                            str_replace(self::CONTROLLER_FOLDER, '', $refClass->name))));
    }
}
