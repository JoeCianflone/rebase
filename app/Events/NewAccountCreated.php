<?php

namespace App\Events;

use App\Domain\Models\Account;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NewAccountCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $account;
    public array $setupData;

    public function __construct(Account $account, array $setupData)
    {
        $this->account = $account->toArray();
        $this->setupData = $setupData;
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
