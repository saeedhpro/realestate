<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use function App\Helpers\toJalali;


class Advertise extends Model
{
    protected $guarded = ['id', 'updated_at', 'created_at'];

    public const TYPE_FOR_SELL = 1;
    public const TYPE_FOR_RENT = 2;
    public const TYPES = [self::TYPE_FOR_SELL, self::TYPE_FOR_RENT];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function tour()
    {
        return $this->hasOne(VrTour::class);
    }

    public function real_estate()
    {
        return $this->belongsTo(RealEstate::class);
    }

    public function estate_type()
    {
        return $this->belongsTo(EstateType::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }


    public function releaseAgo()
    {
//        Carbon::setLocale('fa');
//        return Carbon::parse($this->created_at)->diffForHumans();

        $date = $this->created_at;
        $faDate = toJalali($date);
        return $faDate->diffForHumans();
    }
}
