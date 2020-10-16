<?php

namespace App\Services\Registration;

use App\Domain\Facades\CustomerRepository;
use Laravel\Cashier\Exceptions\PaymentFailure;

class SubscribeCustomer
{
    public function __invoke($payload)
    {
        try {
            CustomerRepository::for($payload->get('customer'))->subscribe([
                'plan' => $payload->get('plan'),
                'method' => $payload->get('payment_method'),
                'options' => [
                    'name' => $payload->get('customer')->name,
                    'email' => $payload->get('email'),
                    'address' => [
                        'line1' => $payload->get('line1'),
                        'line2' => $payload->get('line2'),
                        'city' => $payload->get('city'),
                        'state' => $payload->get('state'),
                        'postal_code' => $payload->get('postal_code'),
                    ],
                ],
            ]);
        } catch (PaymentFailure $e) {
            // event('Payment Failure...');
            return false;
        }

        return $payload;
    }
}
