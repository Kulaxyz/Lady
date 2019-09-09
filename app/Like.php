<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function post() {
        return $this->belongsTo('App\Post');
    }


}
