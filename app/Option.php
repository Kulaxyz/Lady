<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Votable;

class Option extends Model
{
    use Votable;

    protected $fillable = ['name'];

    protected $table = 'options';


}
