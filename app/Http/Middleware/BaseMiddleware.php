<?php

namespace App\Http\Middleware;

use Illuminate\Support\Str;

class BaseMiddleware
{
    protected array $except = [];

    public function shouldIgnore($path): int
    {
        if (count($this->except) <= 0) {
            return false;
        }

        $path = rtrim(ltrim($path, "/"), "/");
        $beginning = "^";
        $end = "$";
        $words = str_replace("*", "[\S+]*", implode('$|^', $this->except));

        $regex = '#'.$beginning . $words . $end .'#';

        return preg_match($regex, $path);
    }

    public function getTLD($request): ?string
    {
        if ($request->get('workspace')) {
            return $request->get('workspace');
        }

        $parts = explode('.',$request->getHost());

        if (count($parts) <= 2 || (count($parts) > 2 && strtolower($parts[0]) === 'www')) {
            // We're going to look and see if a CNAME is set
            return $this->checkForCNAME($parts);
        } else {
            return $parts[0];
        }

        return null;
    }

    private function checkForCNAME(array $hostParts): ?string
    {
        return null;
    }
}
