<?php

declare(strict_types=1);

namespace App\Http\Controllers\Shared\Register;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller as BaseController;

class ProcessRegisterUser extends BaseController
{
    /**
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200', 'string'],
            'email' => ['required', 'email', 'max:200'],
        ]);

        return Redirect::route('view.register.pay')->with([
            'slug' => $request->input('slug'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
    }
}
