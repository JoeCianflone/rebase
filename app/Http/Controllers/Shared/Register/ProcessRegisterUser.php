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
            'address_line1' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'postal_code' => ['required', 'string', 'max:5'],
        ]);

        session([
            'account.name' => $request->input('name'),
            'account.email' => $request->input('email'),
            'account.is_business' => $request->input('is_business'),
            'account.address_line1' => $request->input('address_line1'),
            'account.address_line2' => $request->input('address_line2'),
            'account.address_line3' => $request->input('address_line3'),
            'account.unit_number' => $request->input('unit_number'),
            'account.city' => $request->input('city'),
            'account.state' => $request->input('state'),
            'account.postal_code' => $request->input('postal_code'),
        ]);

        return Redirect::route('view.register.pay')->with([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
    }
}
