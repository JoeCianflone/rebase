<?php

declare(strict_types=1);

namespace App\Http\Controllers\Shared\Register;

use Inertia\Inertia;
use App\Actions\GetView;
use Illuminate\Http\Request;
use App\Domain\Models\Account;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller as BaseController;

class ViewRegisterPay extends BaseController
{
    /**
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        if (!session('account.slug')) {
            return Redirect::route('view.register.workspace');
        }

        $tempAccount = new Account();

        return Inertia::render(GetView::execute($this, 'rebase'), [
            'stripe_key' => config('services.stripe.key'),
            'intent' => $tempAccount->createSetupIntent(),
        ])->withViewData('stripe', true);
    }
}
