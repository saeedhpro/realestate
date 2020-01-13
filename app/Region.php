<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function margins()
    {
        return $this->hasMany(RegionMargin::class);
    }

    public function advertises()
    {
        return $this->hasMany(Advertise::class);
    }
}
