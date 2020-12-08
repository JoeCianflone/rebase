<?php

namespace App\Actions;

use Closure;
use BadMethodCallException;
use Illuminate\Support\Traits\Macroable;


class Action
{
    use Macroable;

    private static string $handler = 'handle';

    public static function __callStatic($method, $parameters)
    {
        if (!static::hasMacro($method)) {
            throw new BadMethodCallException(sprintf('Method %s::%s does not exist.', static::class, $method));
        }

        $macro = static::$macros[$method];

        if ($macro instanceof Closure) {
            throw new BadMethodCallException(sprintf('Method %s cannot be a Closure.', $method));
        }

        return call_user_func_array($macro.'::'.static::$handler, $parameters);
    }

    public static function init(array $macroGroup): void
    {
        static::$macros = array_merge($macroGroup, static::$macros);
    }
}
