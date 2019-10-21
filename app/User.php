<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN = 1;
    const MANAGER = 2;
    const EMPLOYEE = 3;
    const USER = 4;
    const TYPES = [self::ADMIN, self::MANAGER, self::EMPLOYEE, self::USER];

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function advertises()
    {
        return $this->hasMany(Advertise::class);
    }

    public function real_estate()
    {
        return $this->belongsTo(RealEstate::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
