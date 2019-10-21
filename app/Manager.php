<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $fillable = ['user_id', 'real_estate_id'];

    public function real_estates()
    {
        return $this->hasMany(RealEstate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
