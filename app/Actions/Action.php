<?php
namespace App\Actions;

use Closure;
use BadMethodCallException;
use Illuminate\Support\Traits\Macroable;

class Action {
    use Macroable;

    public static function init($arr)
    {
        static::$macros = $arr;
    }

    public static function __callStatic($method, $parameters)
    {
        if (! static::hasMacro($method)) {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s does not exist.', static::class, $method
            ));
        }

        $macro = static::$macros[$method];

        if ($macro instanceof Closure) {
            return call_user_func_array(Closure::bind($macro, null, static::class), $parameters);
        }

        return call_user_func_array($macro . '::handle', $parameters);
    }

}
