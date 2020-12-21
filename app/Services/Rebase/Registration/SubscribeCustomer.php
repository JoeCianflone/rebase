<?php

namespace App\Services\Rebase\Registration;

use App\Domain\Factories\Rebase\CustomerModelFactory;
use App\Domain\Models\Rebase\Admin\Customer;
use Laravel\Cashier\Exceptions\PaymentFailure;
use Laravel\Cashier\Exceptions\SubscriptionUpdateFailure;

class SubscribeCustomer
{
    public function __invoke($payload)
    {
        try {
            $subscribedCustomer = Customer::modelFactory()->subscribe($payload->get('customer'), [
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
        } catch (SubscriptionUpdateFailure $e) {
            dd($e->getMessage());
            // event('Payment Failure...');
            // CustomerRepository::factory($subscribedCustomer)->markAsInactive();

            return false;
        }

        Customer::modelFactory($subscribedCustomer)->markAsActive();

        return $payload;
    }
}
