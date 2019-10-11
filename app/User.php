<?php

namespace App;

use App\Traits\Voter;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Overtrue\LaravelFollow\Traits\CanBookmark;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;
use Overtrue\LaravelFollow\Traits\CanFavorite;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Laravelista\Comments\Commenter;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Voter;
    use CanFollow, CanLike, CanFavorite, CanBeFollowed, Commenter, CanBookmark;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'age', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        "last_online_at" => "datetime",
    ];

    public function posts()
    {
       return $this->hasMany('App\Post');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function allMessages()
    {
        return Message::where('receiver_id', '=',  $this->id)->orWhere('user_id', '=', $this->id);
    }

    public function lastMessage()
    {
        return Message::where(['user_id' => auth()->id(), 'receiver_id' => $this->id])
            ->orWhere(function ($query){
                $query->where(['user_id' => $this->id, 'receiver_id' => auth()->id()]);
            })
            ->orderBy('id', 'DESC')
            ->first();
    }

    public function unreadMessages()
    {
        return Message::where(['receiver_id' => $this->id, 'read_at' => null])->count();
    }
    public function unreadMessagesBy($id)
    {
        return Message::where(['receiver_id' => $id, 'user_id' =>$this->id, 'read_at' => null])->count();
    }

    public function markMessages($id) : void
    {
        $messages = Message::where(['receiver_id' => $this->id, 'user_id' => $id, 'read_at' => null])->get();
        foreach ($messages as $message) {
            $message->read_at = Carbon::now()->toDateString();
            $message->save();
        }
    }
}
