<?php

namespace App\Events;


use App\Models\Users\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class sendConfirmEmail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var mixed
     */
    public $userDisabled;
    /**
     * @var Array
     */
    public $confirmContent;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $userDisabled, array $confirmContent)
    {

        $this->userDisabled = $userDisabled;
        $this->confirmContent = $confirmContent;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
