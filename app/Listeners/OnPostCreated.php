<?php

namespace App\Listeners;

use App\Events\NewPost;
use App\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OnPostCreated
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
    public function handle(NewPost $event)
    {
        Notification::send(User::whereIn('id', $event->getUsers())->get(), new \App\Notifications\NewPost());
    }
}
