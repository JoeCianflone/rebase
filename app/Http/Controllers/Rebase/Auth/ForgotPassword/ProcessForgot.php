<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Auth\ForgotPassword;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ProcessForgot extends Controller
{
    use SendsPasswordResetEmails;

    public function __invoke(Request $request)
    {
        $this->sendResetLinkEmail($request);

        return redirect()->back()->withMessage('Thank you, we will send you an email if we can find your email address');
    }

    protected function sendResetLinkFailedResponse(Request $request, $response): void
    {
        // I'm overriding this because I do not want to send an alert if
        // we cannot find your email address. This silent fail is
        // important so that way people can't search emails
        // via the forgot password link...
    }
}
