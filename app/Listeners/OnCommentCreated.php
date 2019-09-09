<?php

namespace App\Listeners;

use App\Notifications\NewComment;
use App\Post;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Events\CommentCreated;

class OnCommentCreated
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
     * @param CommentCreated $event
     * @return void
     */
    public function handle(CommentCreated $event)
    {
        if ($event->comment->anonimous) {
            $commenter = null;
        } else {
            $commenter = User::find($event->comment->commenter_id);
        }

        $post = Post::find($event->comment->post());
        $users = $post->favoriters()->where('id', '!=', $event->comment->commenter_id)->get();
        Notification::send($users, new NewComment($post, $commenter));
    }
}

