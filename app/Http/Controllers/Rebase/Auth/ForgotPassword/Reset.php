<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Auth\ForgotPassword;

use Inertia\Response;
use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Reset extends Controller
{
    public function __invoke(string $token, Request $request): Response
    {
        return inertia(Action::getView($this), [
            'token' => $token,
            'tokenEmail' => $request->get('email'),
        ]);
    }
}
