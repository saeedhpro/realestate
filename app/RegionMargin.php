<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionMargin extends Model
{
    public $timestamps = false;
    protected $guarded = [
        'id',
    ];

    public function region()
    {
        return $this->hasMany(Region::class);
    }
}
