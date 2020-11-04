<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Web\Register;

use App\Http\Controllers\Controller;
use App\Events\Rebase\StartCustomerSignup;
use App\Http\Requests\Rebase\RegisterNewCustomerRequest;

class RegisterStore extends Controller
{
    /**
     * @return mixed
     */
    public function __invoke(RegisterNewCustomerRequest $request)
    {
        event(new StartCustomerSignup($request->input()));

        dd('done?');
    }
}
