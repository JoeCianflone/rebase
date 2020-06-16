<?php

namespace App\Events;

use App\Domain\Models\User;
use App\Domain\Models\Workspace;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NewAccountCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $user;
    public array $workspace;

    /**
     * Create a new event instance.
     *
     * @param Model|Workspace $workspace
     * @param Model|User      $user
     */
    public function __construct($workspace, $user)
    {
        $this->workspace = collect($workspace)->toArray();
        $this->user = collect($user)->toArray();
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
