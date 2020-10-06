<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Register;

use App\Actions\Action;
use Illuminate\Http\Request;
use App\Domain\Models\Customer;
use App\Http\Controllers\Controller;

class CustomerInfo extends Controller
{
    /**
     * @return mixed
     */
    public function __invoke(Request $request, Customer $customer)
    {
        return inertia(Action::getView($this), [
            'slug' => $request->input('slug'),
            'stripe_key' => config('services.stripe.key'),
            'intent' => $customer->createSetupIntent(),
        ])->withViewData('stripe', true);
    }
}
