<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;


class NewSubscribtion extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $auth_user;
    public $check_if_user_is_subscribed_to_me;

    /**
     * Create a new notification instance.
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
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_name' => $this->auth_user->name,
            'user_email' => $this->auth_user->email,
            'user_image' => $this->auth_user->image,
            'user_uniqueid' => $this->auth_user->unique_id,
            'check_if_user_is_subscribed_to_me' => $this->check_if_user_is_subscribed_to_me
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data' => [
                'user_name' => $this->auth_user->name,
                'user_email' => $this->auth_user->email,
                'user_image' => $this->auth_user->image,
                'user_uniqueid' => $this->auth_user->unique_id,
                'check_if_user_is_subscribed_to_me' => $this->check_if_user_is_subscribed_to_me
            ]
        ]);
    }

}
