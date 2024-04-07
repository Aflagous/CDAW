<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Groupe;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('message.{personneId}', function ($user, $personneId) {
    return $user->id === $personneId;
});


Broadcast::channel('partie.{partieId}', function ($user, $partieId) {
    return $user->groupe->partie_id == $partieId;
});

