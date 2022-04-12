<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UnblockUserEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $unblockedUser;
    public $if_i_still_blocked_the_user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($unblockedUser, $if_i_still_blocked_the_user)
    {
        $this->unblockedUser = $unblockedUser;
        $this->if_i_still_blocked_the_user = $if_i_still_blocked_the_user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("unblocked-user-channel.{$this->unblockedUser->user_id}");

    }
}
