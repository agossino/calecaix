<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendAdminNotification
{
    /**
     * Handle the event.
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;
        Mail::raw("A new user has registered: {$user->email}", function ($message) {
            $message->to('rino.ruggeri@gmail.com')
                    ->subject('New User Registration https://caibo.it/calecai/public');
        });
    }
}

