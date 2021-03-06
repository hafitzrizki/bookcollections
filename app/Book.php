<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    
    public function categories(){
        return $this->belongsToMany('App\Category');//handle many-to-many ke Category Model
    }

    public function orders(){
        return $this->belongsToMany('App\Order');
    }
}
