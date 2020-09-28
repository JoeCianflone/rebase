<?php

declare(strict_types=1);

namespace App\Http\Controllers\Register;

use App\Actions\Action;
use Illuminate\Http\Request;
use App\Domain\Models\Customer;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller as BaseController;

class ViewRegisterPay extends BaseController
{
    /**
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        if (!session('cart.slug')) {
            return Redirect::route('view.register.workspace');
        }

        return inertia(Action::getView($this), [
            'stripe_key' => config('services.stripe.key'),
            'intent' => (new Customer())->createSetupIntent(),
            'cart' => session('cart'),
        ])->withViewData('stripe', true);
    }
}
