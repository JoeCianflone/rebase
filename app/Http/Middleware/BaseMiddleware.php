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

    /**
     * This turns our list of urls into a regex. The format is 2 fold:.
     *
     * 1. If you have a uri with a * at the end
     * /foo/*
     *
     * will become: \/foo\/.*
     *
     * 2. If you have a url with an * in the middle
     * /foo/ * /bar
     *
     * will become: \/foo\/([a-zA-Z\d\-]*?)\/bar
     *
     * Of course they could be combined into something like the following:
     *
     * /foo/ * /bar/*
     *
     * will become: \/foo\/([a-zA-Z\d\-]*?)\/bar/.*
     *
     * Please note if you URL has any funny characters in it you're going to need to adjust this
     */
    private function generateRegexExpression(Collection $exceptCollection): string
    {
        $words = $exceptCollection->map(function ($item, $key) {
            if (Str::endsWith($item, '*')) {
                $item = Str::replaceLast('*', '#', $item);
            }

            $item = str_replace('*', '([a-zA-Z\d\-]*?)', $item);
            $item = str_replace('#', '.*', $item);

            return str_replace('/', '\/', $item);
        })->implode('|^');

        return '#^'.$words.'#';
    }
}
