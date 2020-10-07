<?php

namespace App\Services\Registration;

use App\Domain\Models\Customer;

class AddCustomer
{
    public function __invoke($payload)
    {
        $customer = Customer::create([
            'name' => $payload->get('name'),
            'is_business' => $payload->get('is_business', false),
            'business_name' => $payload->get('business_name'),
            'agreed_to_terms' => $payload->get('agreed_to_terms'),
            'agreed_to_privacy' => $payload->get('agreed_to_privacy'),
        ]);

        $customer->customerAddresses()->create([
            'is_primary' => true,
            'line1' => $payload->get('address_line1'),
            'line2' => $payload->get('address_line2'),
            'line3' => $payload->get('address_line3'),
            'unit_number' => $payload->get('unit_number'),
            'city' => $payload->get('city'),
            'state' => $payload->get('state'),
            'postal_code' => $payload->get('postal_code'),
        ]);

        $payload->put('customer', $customer);

        return $payload;
    }
}
