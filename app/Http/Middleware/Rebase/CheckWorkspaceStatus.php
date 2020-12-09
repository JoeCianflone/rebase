<?php

namespace App\Http\Middleware\Rebase;

use App\Domain\Facades\Rebase\RoleRepository;
use Closure;
use Illuminate\Http\Request;
use App\Enums\Rebase\MemberRoles;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\BaseMiddleware;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class CheckWorkspaceStatus extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    protected array $except = [
        'storage',
        'horizon',
        'register',
        '_debugbar',
        'stripe',
        'design',
        'grid',
        'logout',
        'login',
        'onboarding',
    ];

    public function handle(Request $request, Closure $next)
    {
        if ($this->shouldIgnore($request->path())) {
            return $next($request);
        }

        if (WorkspaceRepository::query()->isPending($request->get('slug'))) {

           if(RoleRepository::query()->isWorkspaceAdminOrUp(Auth::user()->id)) {
               return redirect()->route('onboarding.start');
           }

            return redirect()->route('onboarding.hold');
        } elseif (WorkspaceRepository::query()->isArchived($request->get('slug'))) {
            return redirect()->route('onboarding.hold');
        }

        return $next($request);
    }
}
