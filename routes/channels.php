<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($id) {
    return true;
});

Broadcast::channel('messages.{to}', function ($user, $to) {
    return true;
});

Broadcast::channel('messages.{from}.{to}', function ($user, $from, $to) {
    return true;
});

Broadcast::channel('user_notifications.{to}', function ($to) {
    return true;
});

Broadcast::channel('blocked-user-channel.{blockerId}', function () {
    return true;
});

Broadcast::channel('unblocked-user-channel.{blockerId}', function () {
    return true;
});