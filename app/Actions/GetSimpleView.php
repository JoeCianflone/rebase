<?php

declare(strict_types=1);

namespace App\Actions;

/**
 * Rebase expects Views to be in a very particular location that matches the path/location
 * of the Controller file. For example, if the Controller is here: Controller/Web/Foo.php
 * AND it should have a View file, then the expectation is that that file would be
 * located at js/<DIR>/Pages/Web/Foo.vue. Since this is a pattern we're able
 * to just use code to find the path correctly. This takes a path to a
 * controller and converts it to the correct JS path.
 */
class GetSimpleView
{
    public static function handle(string $filePath, bool $useSecondaryLocation = false): string
    {
        $location = $useSecondaryLocation ? config('app-paths.views.secondary_location') : config('app-paths.views.default_location');

        $path = config("app-paths.views.{$location}.pages");

        $filePath = collect(explode('/', $filePath))->map(function ($item, $key) {
            return collect(explode('-', $item))->map(function ($item, $key) {
                return \ucfirst($item);
            })->implode('');
        })->implode('/');

        return "{$path}/{$filePath}";
    }
}
