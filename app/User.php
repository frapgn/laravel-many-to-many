<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationships
    public function master_data()
    {
        return $this->hasOne('App\MasterData');
    }

    public function category()
    {
        return $this->hasMany('App\Category');
    }

    public function tag()
    {
        return $this->hasMany('App\Tag');
    }

    public function page()
    {
        return $this->hasMany('App\Page');
    }

    public function photo()
    {
        return $this->hasMany('App\Photo');
    }
}
