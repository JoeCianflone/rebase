<?php

declare(strict_types=1);

namespace App\Actions;

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
