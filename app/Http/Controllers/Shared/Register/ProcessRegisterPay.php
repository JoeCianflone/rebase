<?php

declare(strict_types=1);

namespace App\Http\Controllers\Shared\Register;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\NewAccountCreated;
use Illuminate\Support\Facades\Redirect;
use App\Domain\Repositories\Facades\AccountRepository;
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

        $account = AccountRepository::create([
            'id' => Str::uuid(),
            'name' => session('account.name'),
            'address_line1' => session('account.address_line1'),
            'address_line2' => session('account.address_line2'),
            'address_line3' => session('account.address_line3'),
            'city' => session('account.city'),
            'state' => session('account.state'),
            'is_business' => (bool) session('account.is_business'),
            'postal_code' => session('account.postal_code'),
        ]);

        // @phpstan-ignore-next-line
        $account->newSubscription(config('pricing.plan.test'), $request->input('plan'))->create($request->input('payment_method'));

        event(new NewAccountCreated($account, [
            'slug' => session('account.slug'),
            'name' => session('account.user.name'),
            'email' => session('account.email'),
        ]));

        session()->flush();

        return Redirect::route('view.register.complete');
    }
}
