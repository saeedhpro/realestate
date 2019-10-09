<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function advertises()
    {
        return $this->belongsToMany(Advertise::class);
    }
}
