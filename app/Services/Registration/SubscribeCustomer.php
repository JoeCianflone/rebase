<?php

namespace App\Services\Registration;

use Laravel\Cashier\Exceptions\PaymentFailure;

class SubscribeCustomer
{
    public function __invoke($payload)
    {
        try {
            $payload->get('customer')->newSubscription(config('pricing.plan.test'), $payload->get('plan'))
                ->create(
                    $payload->get('payment_method'),
                    [
                        'name' => $payload->get('customer')->business_name ?? $payload->get('customer')->name,
                        'email' => $payload->get('email'),
                        'address' => [
                            'line1' => $payload->get('address_line1'),
                            'line2' => $payload->get('address_line2'),
                            'city' => $payload->get('city'),
                            'state' => $payload->get('state'),
                            'postal_code' => $payload->get('postal_code'),
                        ],
                    ]
                );
        } catch (PaymentFailure $e) {
            // event('Payment Failure...');
            return false;
        }

        return $payload;
    }
}
