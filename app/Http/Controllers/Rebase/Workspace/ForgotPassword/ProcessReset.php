<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\ForgotPassword;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ProcessReset extends Controller
{
    use ResetsPasswords;

    public function __invoke(Request $request): void
    {
        $this->reset($request);
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
