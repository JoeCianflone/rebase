<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Domain\Models\Workspace;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class WorkspaceCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $workspace;
    public array $setupData;

    /**
     * Create a new event instance.
     */
    public function __construct(Workspace $workspace, array $setupData = [])
    {
        $this->workspace = collect($workspace)->toArray();
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
