<?php

use Illuminate\Support\Facades\Broadcast;

// Auth channel for users
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Chat channel
Broadcast::channel('chat', function ($user) {
    return [
        'id' => $user->id,
        'name' => $user->name
    ];
    // return true;
});

// Broadcast::channel('public-updates', function () {
//     return true;
// });
