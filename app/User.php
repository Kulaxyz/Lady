<?php

namespace App;

use App\Traits\Voter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;
use Overtrue\LaravelFollow\Traits\CanFavorite;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Laravelista\Comments\Commenter;




class User extends Authenticatable
{
    use Notifiable;
    use Voter;
    use CanFollow, CanLike, CanFavorite, CanBeFollowed, Commenter;

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
    ];

    public function posts()
    {
       return $this->hasMany('App\Post');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function lastMessage($id)
    {
//        dd( $this->messages()->get());
        $msgs = $this->messages()->get();


        return $msgs->where('receiver_id', '=', $id)->where('receiver_id', '=', $id)->first();
    }

}
