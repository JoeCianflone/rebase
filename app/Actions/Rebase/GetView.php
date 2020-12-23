<?php declare(strict_types=1);

namespace App\Actions\Rebase;

use ReflectionClass;
use App\Contracts\Rebase\Actionable;

class GetView implements Actionable
{
    public static function handle(...$payload): string
    {
        [$class] = $payload;

        return config('paths.views.pages').str_replace(ucfirst(config('paths.controllers')), '', str_replace('\\', '/', (new ReflectionClass($class))->name));
    }
}
