<?php

namespace App;

class Employee extends User
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function realestate()
    {
        return $this->belongsTo(RealEstate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function advertises()
    {
        return $this->hasMany(Advertise::class);
    }
}
