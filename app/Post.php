<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeBookmarked;
use Overtrue\LaravelFollow\Traits\CanBeFavorited;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Laravelista\Comments\Commentable;
use Overtrue\LaravelFollow\Traits\CanBeVoted;


class Post extends Model
{
    use CanBeLiked, CanBeFavorited, Commentable, CanBeBookmarked;

    protected $table = 'posts';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tag');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function options()
    {
        return $this->hasMany('App\Option');
    }

    public function votes()
    {
        return $this->hasManyThrough(Vote::class, Option::class);
    }


    public static function boot() {
        parent::boot();

        static::deleting(function(Post $post) {
            $post->images()->delete();
            $post->options()->delete();
            $post->votes()->delete();
        });
    }


}
