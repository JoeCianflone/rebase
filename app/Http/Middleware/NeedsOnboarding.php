<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class NeedsOnboarding
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!WorkspaceRepository::hasBeenOnboarded($request->get('slug'))) {
            return redirect()->route('onboarding.start');
        }

        return $next($request);
    }
}
