<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewPost implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $users;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($result)
    {
        $this->users = $result;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channels = [];
        if (!empty($this->users)) {
            if (is_array($this->users)) {
                foreach ($this->users as $user) {
                    array_push($channels, new PrivateChannel('usermy.' . $user));
                }
            } else {
                return new PrivateChannel('usermy.' . $this->users);
            }
        } else {
            array_push($channels, new PrivateChannel('usermy.9999'));
        }
        return $channels;
    }

    public function getUsers()
    {
        return $this->users;
    }
}
