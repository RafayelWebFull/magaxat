<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewSubscribtionEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    public $auth_user;
    public $check_if_user_is_subscribed_to_me;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $auth_user, $check_if_user_is_subscribed_to_me)
    {
        $this->user = $user;
        $this->auth_user = $auth_user;
        $this->check_if_user_is_subscribed_to_me = $check_if_user_is_subscribed_to_me;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("user_notifications.{$this->user->id}");
    }

    public function broadcastWith()
    {
        return [
            'auth_user' => $this->auth_user
        ];
    }
}
