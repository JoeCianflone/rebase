<?php

namespace App\Http\Middleware\Rebase;

use Closure;
use Illuminate\Support\Facades\App;

class NotProduction
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
        if (!App::environment('local', 'staging')) {
            abort(404);
        }

        return $next($request);
    }
}
