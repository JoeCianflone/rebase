<?php

namespace App\Http\Middleware\Rebase;

use Closure;
use Illuminate\Http\Request;
use App\Enums\Rebase\MemberRoles;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\BaseMiddleware;
use App\Domain\Facades\Rebase\RoleRepository;
use App\Domain\Models\Rebase\Workspace\Workspace;
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

        $workspace = Workspace::bysub($request->get('sub'))->first();

        if ($workspace->isPending()) {
           if(auth()->user()->roles->hasAccountRole()) {
               return redirect()->route('onboarding.start');
           }

            return redirect()->route('onboarding.hold');
        } elseif ($workspace->isArchived()) {

            return redirect()->route('onboarding.hold');
        }

        return $next($request);
    }
}
