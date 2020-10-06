<?php

declare(strict_types=1);

namespace App\Http\Controllers\ForgotPassword;

use Inertia\Response;
use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewForgot extends Controller
{
    public function __invoke(Request $request): Response
    {
        return inertia(Action::getView($this));
    }
}
