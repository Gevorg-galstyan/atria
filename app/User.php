<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'address', 'status', 'rol', 'href', 'new', 'phone','driver_id', 'driver_token','driver_link',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function messages(){
        return $this->hasMany('App\Models\Message','user_id','id');
    }
    public function messagesSeen(){
        return $this->hasMany('App\Models\Message','to_id','id');
    }
}
