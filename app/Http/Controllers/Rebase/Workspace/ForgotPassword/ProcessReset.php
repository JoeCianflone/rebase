<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\ForgotPassword;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ProcessReset extends Controller
{
    use ResetsPasswords;

    public function __invoke(Request $request)
    {
        $this->reset($request);

        return redirect()->route('login')->withSuccess('You have changed your password');
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:12',
        ];
    }
}
