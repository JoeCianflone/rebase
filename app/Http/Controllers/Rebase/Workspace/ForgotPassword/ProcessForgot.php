<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\ForgotPassword;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ProcessForgot extends Controller
{
    use SendsPasswordResetEmails;

    public function __invoke(Request $request)
    {
        $this->sendResetLinkEmail($request);

        return redirect()->back()->withSuccess('Check your email');
    }
}
