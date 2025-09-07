<?php

use App\Events\UserEvent;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Broadcast::routes(['middleware' => ['auth']]);
Route::get('test', function () {
    // broadcast(new UserEvent());
    broadcast(new UserEvent());
    return 'Event broadcasted';
});

require __DIR__.'/auth.php';
