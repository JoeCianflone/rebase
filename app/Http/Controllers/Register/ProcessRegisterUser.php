<?php

declare(strict_types=1);

namespace App\Http\Controllers\Register;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RegisterAccountRequest;
use App\Http\Controllers\Controller as BaseController;

class ProcessRegisterUser extends BaseController
{
    /**
     * @return mixed
     */
    public function __invoke(RegisterAccountRequest $request)
    {
        [$mergedData['cart']] = [array_merge(session('cart'), $request->all())];
        session($mergedData);

        return Redirect::route('view.register.pay');
    }
}
