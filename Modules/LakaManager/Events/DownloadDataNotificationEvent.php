<?php

namespace Modules\LakaManager\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DownloadDataNotificationEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $success;
    public $targetId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($success, $message, $id)
    {
        $this->success = $success;
        $this->message = $message;
        $this->targetId = $id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-download');
    }
}
