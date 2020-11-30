<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Guest\Registers;

use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Models\Rebase\Customer\Customer;

class RegisterCustomer extends Controller
{
    /**
     * @return mixed
     */
    public function __invoke(Request $request, Customer $intent)
    {
        return inertia(Action::getView($this), [
            'slug' => $request->input('slug'),
            'stripe_key' => config('services.stripe.key'),
            'intent' => $intent->createSetupIntent(),
        ])->withViewData('withStripe', true);
    }
}
