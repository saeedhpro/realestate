<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\EstateType;
use App\Http\Resources\AdvertiseCollectionResource;
use App\Http\Resources\AdvertiseResource;
use App\Property;
use App\RealEstate;
use App\State;
use App\User;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
//        $real_estates = RealEstate::with('city')->take(8)->get();
//        $sell_advs = Advertise::where('advertise_type', '=', Advertise::TYPE_FOR_SELL)->with('city')->take(8)->get();
//        $rent_advs = Advertise::where('advertise_type', '=', Advertise::TYPE_FOR_RENT)->with('city')->take(8)->get();
//        $sell_count = count(Advertise::where('advertise_type', '=', Advertise::TYPE_FOR_SELL)->get());
//        $rent_count = count(Advertise::where('advertise_type', '=', Advertise::TYPE_FOR_RENT)->get());
//        $real_estate_count = count(RealEstate::all());
//        $estate_types = EstateType::all();
//        $states = State::all();
//
//        return view('home.home', compact('real_estates', 'states', 'estate_types', 'sell_advs', 'rent_advs', 'sell_count', 'rent_count', 'real_estate_count'));

        $advertises = Advertise::orderBy('created_at', 'desc')->paginate(8);
        $states = State::all();
        $estate_types = EstateType::all();
        return view('home.home', compact('estate_types', 'advertises'));
    }

    public function compares()
    {
        $v = Validator::make(request()->all(), [
            'ads' => 'array'
        ]);
        if($v->validate()){
            $ads_list = request()->ads;
            /** @var Advertise $ads */
            $ads = Advertise::all()->whereIn('id', $ads_list);
            $properties = Property::all();
            return view('main.advertise.compare', compact('ads', 'properties'));
        } else {
            return redirect(route('home'));
        }
    }
}
