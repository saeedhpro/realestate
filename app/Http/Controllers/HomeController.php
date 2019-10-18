<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\EstateType;
use App\RealEstate;
use App\State;
use Illuminate\Http\Request;
use function foo\func;

class HomeController extends Controller
{
    public function index()
    {
        $real_estates = RealEstate::with('city')->take(8)->get();
        $sell_advs = Advertise::where('advertise_type', '=', Advertise::TYPE_FOR_SELL)->with('city')->take(8)->get();
        $rent_advs = Advertise::where('advertise_type', '=', Advertise::TYPE_FOR_RENT)->with('city')->take(8)->get();
        $sell_count = count(Advertise::where('advertise_type', '=', Advertise::TYPE_FOR_SELL)->get());
        $rent_count = count(Advertise::where('advertise_type', '=', Advertise::TYPE_FOR_RENT)->get());
        $real_estate_count = count(RealEstate::all());
        $states = State::all();
        $estate_types = EstateType::all();
        return view('home.home', compact('real_estates', 'states', 'estate_types', 'sell_advs', 'rent_advs', 'sell_count', 'rent_count', 'real_estate_count'));
    }
}
