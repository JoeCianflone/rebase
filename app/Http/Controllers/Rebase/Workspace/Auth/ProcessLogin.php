<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Rebase\LoginRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class ProcessLogin extends Controller
{
    use ThrottlesLogins;

    public function __invoke(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'), $request->get('remember'))) {
            return redirect()->back()->withErrors('We cannot find your username/password');
        }

        return redirect()->route('dashboard');
    }
}
