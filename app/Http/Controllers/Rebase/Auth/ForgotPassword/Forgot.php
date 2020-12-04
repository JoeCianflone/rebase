<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Auth\ForgotPassword;

use Inertia\Response;
use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Forgot extends Controller
{
    public function __invoke(Request $request): Response
    {
        return inertia(Action::getView($this), [
            'to' => $request->query('to'),
            'customer_id' => $request->query('customer_id'),
        ]);
    }
}
