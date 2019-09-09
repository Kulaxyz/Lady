<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;


class Tag extends Model
{
    use CanBeFollowed;

    protected $table = 'tags';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_tag');
    }
}
