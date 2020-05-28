<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function page()
    {
        return $this->belongsToMany('App\Page');
    }
}
