<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Auth;

use App\Actions\Action;
use App\Enums\Rebase\MemberRoles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Rebase\LoginRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class ProcessLogin extends Controller
{
    use ThrottlesLogins;

    public function __invoke(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'), $request->get('remember'))) {
            return redirect()->back()->withErrors('We cannot find your username/password');
        }

        if (!WorkspaceRepository::hasBeenOnboarded($request->get('slug'))) {
            if (Action::activeRole($request->get('slug') === MemberRoles::OWNER())) {
                return redirect()->route('onboarding.start');
            }

            return redirect()->route('onboarding.hold');
        }

        return redirect()->route('dashboard');
    }
}
