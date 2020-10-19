<?php

namespace App\Http\Middleware\Rebase;

use Closure;
use Illuminate\Support\Facades\App;

class OnlyStaging
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
        if (!App::environment('staging')) {
            abort(404);
        }

        return $next($request);
    }
}
