<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class StartCustomerSignup
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $payload;

    /**
     * Create a new event instance.
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }
}
