<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];
    
    public function question(){
        return $this->belongsTo('App\question');
    }

    public function user(){
        return $this->belongsTo('App\user');
    }

    public function like(){
        return $this->hasMany('App\Like');
    }
}
