<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'linkedin',
        'twitter',
        'github',
        'avatar_path'
    ];

    // Relationships
    public function user()
    {
        return $this->belongTo('App\User');
    }
}
