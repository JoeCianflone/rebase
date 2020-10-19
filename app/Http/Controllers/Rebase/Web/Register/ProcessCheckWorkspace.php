<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Web\Register;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Rebase\CheckWorkspaceRequest;

class ProcessCheckWorkspace extends Controller
{
    public function __invoke(CheckWorkspaceRequest $request)
    {
        return Redirect::route('register.index', ['slug' => $request->input('slug')]);
    }
}
