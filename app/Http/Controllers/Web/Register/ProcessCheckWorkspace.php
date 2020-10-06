<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Register;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CheckWorkspaceRequest;

class ProcessCheckWorkspace extends Controller
{
    /**
     * @return mixed
     */
    public function __invoke(CheckWorkspaceRequest $request)
    {
        return Redirect::route('register.index', ['slug' => $request->input('slug')]);
    }
}
