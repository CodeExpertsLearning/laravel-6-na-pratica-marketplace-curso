<?php

namespace App\Events;

use App\UserOrder;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserOrderedItems
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userOrder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UserOrder $userOrder)
    {
        $this->userOrder = $userOrder;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
