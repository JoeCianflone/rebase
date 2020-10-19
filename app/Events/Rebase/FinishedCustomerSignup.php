<?php

namespace App\Events\Rebase;

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
     *
     * @param mixed $customerInfo
     */
    public function __construct($customerInfo)
    {
        $this->payload = $customerInfo;
    }
}
