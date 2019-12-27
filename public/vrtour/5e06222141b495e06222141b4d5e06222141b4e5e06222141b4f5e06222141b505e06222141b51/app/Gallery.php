<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function advertise()
    {
        return $this->belongsTo(Advertise::class);
    }
}
