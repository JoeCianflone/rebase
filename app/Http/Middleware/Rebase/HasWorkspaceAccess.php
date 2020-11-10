<?php

namespace App\Http\Middleware\Rebase;

use Closure;
use App\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domain\Facades\Rebase\MemberRepository;

class HasWorkspaceAccess
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $workspaceRole = MemberRepository::query(Auth::user())->getWorkspaceRole($request->get('workspace_id'));

        if (is_null($workspaceRole)) {
            return redirect()->route('workspace.choice')->withMessage('You do not have access to that Workspace, please contact your administrator');
        }

        Action::activeRole([$request->get('slug') => $workspaceRole]);

        return $next($request);
    }
}
