<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class StartAccountSignup
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $cart;

    /**
     * Create a new event instance.
     */
    public function __construct(array $cart)
    {
        $this->cart = $cart['cart'];
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
