<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VrTour extends Model
{
    protected $guarded = [
        'id'
    ];

    public function advertise()
    {
        return $this->belongsTo(Advertise::class);
    }
}
