<?php

declare(strict_types=1);

namespace App\Actions\Rebase;

use ReflectionClass;

class GetView
{
    public static function handle(object $class): string
    {
        return 'Pages'.str_replace(ucfirst(config('app-paths.controllers')), '', str_replace('\\', '/', (new ReflectionClass($class))->name));
    }
}
