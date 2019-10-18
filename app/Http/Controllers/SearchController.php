<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\City;
use App\EstateType;
use App\Property;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $room_nums = Advertise::all()->sortBy('room')->unique('room');
        $states = State::all();
        $state = null;
        $cities = new Collection();
        $estate_types = EstateType::all();
        $ets = [];
        if($request->ets){
            $ets = $request->ets;
        }
        if($request->state_id){
            $state = State::find($request->state_id);
            $cities = City::where('state_id', '=', $state->id)->get();
        }
        $city = null;
        if($request->city_id){
            $city = City::find($request->city_id);
        }
        $properties = Property::all();
        $pids = [];
        if($request->props) {
            $pids = $request->props;
        }
        $rooms = [];
        if($request->rooms){
            $rooms = $request->rooms;
        }
        $ads = Advertise::orderBy('created_at', 'desc');
        if($request->st == 'buy'){
            $ads = $ads->where('advertise_type', '=', Advertise::TYPE_FOR_SELL);
        }
        if($request->st == 'rent'){
            $ads = $ads->where('advertise_type', '=', Advertise::TYPE_FOR_RENT);
        }
        if($request->rooms){
            $ads = $ads->whereIn('room', $request->rooms);
        }
        if($request->ets){
            $ads = $ads->whereIn('estate_type_id', $request->ets);
        }
        if($request->state_id){
            $ads = $ads->where('state_id', '=', $request->state_id);
        }
        if($request->city_id){
            $ads = $ads->where('city_id', '=', $request->city_id);
        }
        if($request->props){
            $props = $request->props;
            $ads = $ads->whereHas('properties', function ($q) use($props){
                $q->whereIn('id', $props);
            });
        }
        $ads = $ads->paginate(10);
        return view('main.search.search', compact('ads', 'estate_types', 'ets', 'states', 'cities', 'state', 'city', 'properties', 'pids', 'room_nums','rooms'));
    }
}
