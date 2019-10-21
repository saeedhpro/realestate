<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class RealEstate extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];
    public $timestamps = false;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function advertises()
    {
        return $this->hasMany(Advertise::class);
    }

    public function manager()
    {
        return $this->hasMany(User::class)->where('type', '=', User::MANAGER)->orWhere('type', '=', User::ADMIN)->first();
    }

    public function employees()
    {
        return $this->hasMany(User::class)->where('type', '=', User::EMPLOYEE);
    }

}
