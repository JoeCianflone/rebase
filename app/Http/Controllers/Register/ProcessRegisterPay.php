<?php

declare(strict_types=1);

namespace App\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Events\StartAccountSignup;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller as BaseController;

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

        event(new StartAccountSignup($cart));
        session()->flush();

        // event(new NewAccountCreated($account, [
        //     'slug' => session('account.slug'),
        //     'name' => session('account.user.name'),
        //     'email' => session('account.email'),
        // ]));

        return Redirect::route('view.register.complete');
    }
}
