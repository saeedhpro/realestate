<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstateType extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function advertises()
    {
        return $this->hasMany(Advertise::class);
    }
}
