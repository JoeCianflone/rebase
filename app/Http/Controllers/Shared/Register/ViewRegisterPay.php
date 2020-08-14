<?php

declare(strict_types=1);

namespace App\Http\Controllers\Shared\Register;

use Inertia\Inertia;
use Inertia\Response;
use App\Actions\GetView;
use Illuminate\Http\Request;
use App\Domain\Models\Account;
use App\Http\Controllers\Controller as BaseController;

class ViewRegisterPay extends BaseController
{
    public function __invoke(Request $request): Response
    {
        $tempAccount = new Account();

        return Inertia::render(GetView::execute($this, 'rebase'), [
            'slug' => session('slug'),
            'name' => session('name'),
            'email' => session('email'),
            'stripe_key' => config('services.stripe.key'),
            'intent' => $tempAccount->createSetupIntent(),
        ])->withViewData('stripe', true);
    }
}
