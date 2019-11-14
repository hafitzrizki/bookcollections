<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function books(){
        return $this->belongsToMany('App\Book');//handle many-to-many ke Book Model
    }
}
