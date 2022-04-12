<?php

namespace App\Listeners;

use App\Notifications\NewSubscribtion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NewSubscribtionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Notification::send($event->user, new NewSubscribtion($event->user, $event->auth_user, $event->check_if_user_is_subscribed_to_me));
    }
}
