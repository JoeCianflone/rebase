<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Auth;

use Inertia\Response;
use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Login extends Controller
{
    public function __invoke(Request $request): Response
    {
        return inertia(Action::getView($this), [
            'customer_id' => $request->get('customer_id'),
            'to' => $request->get('to'),
        ]);
    }
}
