<?php

declare(strict_types=1);

namespace App\Actions;

use ReflectionClass;

 /**
  * This will look at the current controller, same something named like this:
  *      App\Http\Controllers\Dashboard\IndexDashboardController
  * and convert it to this:
  *      js/Rebase/Dashboard/IndexDashboard
  * because that is where the Index file should be located.
  */
 class GetView
 {
     public static function handle(object $class, bool $useSecondaryLocation = false): string
     {
         $location = $useSecondaryLocation ? config("app-paths.views.secondary_location") : config("app-paths.views.default_location");

         $path = config("app-paths.views.{$location}.pages");

         return $path.str_replace(ucfirst(config('app-paths.controllers')), '', str_replace('\\', '/', (new ReflectionClass($class))->name));
     }
 }
