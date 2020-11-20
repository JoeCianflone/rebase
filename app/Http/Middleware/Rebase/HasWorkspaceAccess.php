<?php

namespace App\Http\Middleware\Rebase;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasWorkspaceAccess
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (is_null(Auth::user()->role($request->get('workspace_id')))) {
            return redirect()->route('workspace.choice')->withMessage('You do not have access to that Workspace, please contact your administrator');
        }

        return $next($request);
    }
}
