<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Register;

use App\Events\StartCustomerSignup;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterNewCustomerRequest;

class ProcessCustomer extends Controller
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
