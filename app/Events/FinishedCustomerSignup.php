<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class FinishedCustomerSignup
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $payload;

    /**
     * Create a new event instance.
     */
    public function __construct(array $customerInfo)
    {
        $this->payload = $customerInfo;
    }
}
