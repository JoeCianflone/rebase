<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class OnlyLocal
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!App::environment('local')) {
            abort(404);
        }

        return $next($request);
    }
}
