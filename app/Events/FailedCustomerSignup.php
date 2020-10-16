<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class FailedCustomerSignup
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $payload;

    /**
     * Create a new event instance.
     *
     * @param mixed $failMessage
     * @param mixed $event
     */
    public function __construct(array ...$customer)
    {
        $this->payload['message'] = $customer['message'];
        $this->payload['customer'] = $customer['request'];
    }
}
