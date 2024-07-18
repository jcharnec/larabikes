<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bike;
use App\Models\User;


class FirstBikeCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bike, $user;
    
    /**
     * Summary of __construct
     * @param \App\Models\Bike $bike
     * @param \App\Models\User $user
     */
    public function __construct(Bike $bike, User $user)
    {
        $this->bike = $bike;
        $this->user = $user;
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
