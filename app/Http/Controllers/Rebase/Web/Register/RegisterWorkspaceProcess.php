<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Web\Register;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rebase\CheckWorkspaceRequest;

class RegisterWorkspaceProcess extends Controller
{
    public function __invoke(CheckWorkspaceRequest $request)
    {
        return Inertia::location(route('register.customer', ['slug' => $request->input('slug')]));
    }
}
