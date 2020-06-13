<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    protected $with = ['replies'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
        return $this->belongsTo('App\user');
    }

    public function replies(){
        return $this->hasMany('App\reply')->latest();
    }

    public function category(){
        return $this->belongsTo('App\category');   
    }

    public function getPathAttribute(){
        return "question/$this->slug";
    }
}
