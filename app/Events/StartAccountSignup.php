<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class StartAccountSignup
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $cart;

    /**
     * Create a new event instance.
     *
     * @param mixed $cart
     */
    public function __construct($cart)
    {
        $this->cart = $cart['cart'];
    }
}
