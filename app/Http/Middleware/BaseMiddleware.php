<?php

namespace App\Http\Middleware;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class BaseMiddleware
{
    protected array $except = [];

    public function shouldIgnore($path)
    {
        if (count($this->except) <= 0) {
            return false;
        }

        $path = rtrim(ltrim($path, '/'), '/');

        $regex = $this->generateRegexExpression(collect($this->except));

        return preg_match($regex, $path) > 0;
    }

    private function generateRegexExpression(Collection $exceptCollection): string
    {
        $regexString = $exceptCollection->map(function ($item, $key) {
            $item = rtrim($item, '/');

            // We need this temp state because all other * need to transform into something else that's non-greedy
            // but the last * should be greedy and just look for anything if anyone can come up with a
            // better and still readable way to do this I'm all ears.
            if (Str::endsWith($item, '*')) {
                $item = Str::replaceLast('*', '#', $item);
            }

            // Order here is important

            return str_replace('/', '\/', str_replace('#', '.*', str_replace('*', '([a-zA-Z\d\-]*?)', $item)));
        })->implode('|^');

        return '#^'.$regexString.'#';
    }
}
