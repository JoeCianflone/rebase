<?php

namespace App\Services\Registration;

use Closure;
use App\Contracts\Pipe;
use Laravel\Cashier\Exceptions\PaymentFailure;
use App\Domain\Facades\AccountRepository;

class CreateNewAccountAndSubscription implements Pipe
{
    public function handle($payload, Closure $next)
    {
        $account = AccountRepository::create($payload);

        try {
            $account->newSubscription(config('pricing.plan.test'), $payload['plan'])
                ->create(
                    $payload['payment_method'],
                    [
                        'name' => $account->business_name ?? $account->name,
                        'email' => session('cart.email'),
                        'address' => [
                            'line1' => $account->address_line1,
                            'line2' => $account->address_line2,
                            'city' => $account->city,
                            'state' => $account->state,
                            'postal_code' => $account->postal_code,
                        ],
                    ]
                );
        } catch (PaymentFailure $e) {
            // event('Payment Failure...');
            return false;
        }

        return $next($payload);
    }
}
