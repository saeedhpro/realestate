<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    public function real_estates()
    {
        return $this->hasMany(RealEstate::class);
    }
}
