<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Guest\Registers;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rebase\CheckWorkspaceRequest;

class RegisterValidateSlug extends Controller
{
    public function __invoke(CheckWorkspaceRequest $request)
    {
        // This generats a 409 Conflict on purpose see InertiaJS
        // docs for more info: https://inertiajs.com
        return Inertia::location(route('register.customer', ['slug' => $request->input('slug')]));
    }
}
