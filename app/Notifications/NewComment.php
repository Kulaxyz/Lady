<?php

namespace App\Notifications;

use App\Post;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewComment extends Notification implements ShouldBroadcast
{
    use Queueable;


    private $user;
    private $post;

    /**
     * Create a new notification instance.
     *
     * @param Post $post
     * @param User|null $user
     */
    public function __construct(Post $post, User $user = null)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $title = $this->post->title;
        if (!is_null($this->user)) {
            $name = $this->user->name;
            return [
                'data' => "<strong><a href='" . route('profile', $this->user->id) .
                    "'>$name</a></strong> прокомментировала запись <a href='" .
                    route('show', $this->post->slug) ."'><strong>$title</strong></a>."
            ];
        }
        $name = 'Аноним';
        return [
            'data' => "<strong>$name</strong> прокомментировала запись <a href='" .
                route('show', $this->post->id) ."'><strong>$title</strong></a>."
        ];


    }
}
