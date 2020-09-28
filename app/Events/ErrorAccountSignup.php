<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ErrorAccountSignup
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $cart;
    public string $type;

    /**
     * Create a new event instance.
     */
    public function __construct(array $cart, string $type)
    {
        [$this->cart] = [$cart];
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array|\Illuminate\Broadcasting\Channel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
