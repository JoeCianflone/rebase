<?php

declare(strict_types=1);

namespace App\Http\Controllers\Shared\Register;

use App\Http\Requests\SlugRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller as BaseController;

class ProcessRegisterWorkspace extends BaseController
{
    /**
     * @return mixed
     */
    public function __invoke(SlugRequest $request)
    {
        session(['account.slug' => $request->input('slug')]);

        return Redirect::route('view.register.user');
    }
}
