<?php

namespace App\Http\Middleware;

use Illuminate\Support\Str;

class BaseMiddleware
{
    protected array $except = [];

    public function shouldIgnore(string $path): bool
    {
        if (count($this->except) <= 0) {
            return false;
        }

        $path = rtrim(ltrim($path, "/"), "/");
        $beginning = "^";
        $end = "$";
        $words = str_replace("*", "[\S+]*", implode('$|^', $this->except));

        $regex = '#'.$beginning . $words . $end .'#';

        return preg_match($regex, $path) > 0;
    }
}
