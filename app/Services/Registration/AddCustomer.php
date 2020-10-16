<?php

namespace App\Services\Registration;

use Carbon\Carbon;
use App\Domain\Facades\CustomerRepository;

class AddCustomer
{
    public function __invoke($payload)
    {
        $customer = CustomerRepository::create([
            'name' => $payload->get('name'),
            'line1' => $payload->get('line1'),
            'line2' => $payload->get('line2'),
            'line3' => $payload->get('line3'),
            'unit_number' => $payload->get('unit_number'),
            'city' => $payload->get('city'),
            'state' => $payload->get('state'),
            'postal_code' => $payload->get('postal_code'),
            'agreed_to_terms' => $payload->get('agreed_to_terms'),
            'agreed_to_privacy' => $payload->get('agreed_to_privacy'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $payload->put('customer', $customer);

        return $payload;
    }
}
