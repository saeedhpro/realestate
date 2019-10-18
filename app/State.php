<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
