<?php

declare(strict_types=1);

namespace App\Http\Controllers\Register;

use Illuminate\Http\Request;
use League\Pipeline\Pipeline;
use App\Events\StartAccountSignup;
use Illuminate\Support\Facades\Redirect;
use App\Services\Registration\CreateNewDatabase;
use App\Services\Registration\CreateNewWorkspace;
use App\Http\Controllers\Controller as BaseController;
use App\Services\Registration\CreateFirstAdministrator;
use App\Services\Registration\CreateNewAccountAndSubscription;

class ProcessRegisterPay extends BaseController
{
    /**
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'plan' => ['required'],
        ]);

        [$cart['cart']] = [array_merge(session('cart'), $request->all())];

        // event(new StartAccountSignup($cart));

        (new Pipeline())
            ->pipe(new CreateNewAccountAndSubscription())
                // ->pipe(new CreateNewDatabase)
                // ->pipe(new CreateFirstAdministrator)
                // ->pipe(new CreateNewWorkspace)
            ->process($cart['cart']);

        // session()->flush();

        return Redirect::route('view.register.complete');
    }
}
