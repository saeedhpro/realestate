<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\City;
use App\EstateType;
use App\Property;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $allAds = Advertise::orderBy('created_at', 'desc')->get();
//        $ads = $allAds->forPage($request->get('page',1), 8);
        $states = State::all();
        $cities = new Collection();
        $city = null;
        $estate_types = EstateType::all();
        $room_nums = Advertise::all()->sortBy('room')->unique('room');
        $rooms = [];
        $ets = [];
        $properties = Property::all();
        $pids = [];
        $page = 1;
        if($request->page){
            $page = $request->page;
        }
        if($request->ets){
            $ets = $request->ets;
        }
        if($request->state_id){
            $state = State::find($request->state_id);
            $cities = City::where('state_id', '=', $state->id)->get();
        }
        if($request->city_id){
            $city = City::find($request->city_id);
        }
        $st = 'all';
        if($request->st == 'all' || !$request->st) {
            $st = 'all';
            $allAds = $allAds->filter(function ($adv) {
                return true;
            });
        }
        if($request->st == 'buy') {
            $st = 'buy';
            $allAds = $allAds->filter(function ($adv) {
                return $adv->advertise_type ==  Advertise::TYPE_FOR_SELL;
            });
        }
        if($request->st == 'rent'){
            $st = 'rent';
            $allAds = $allAds->filter(function ($adv) {
                return $adv->advertise_type ==  Advertise::TYPE_FOR_RENT;
            });
        }
        if($request->rooms){
            $rooms = $request->rooms;
        }
        if($request->props) {
            $pids = $request->props;
        }

        $msp = $allAds->filter(function ($adv){
            return $adv->advertise_type == Advertise::TYPE_FOR_SELL;
        })->max('sell');
        $mrp = $allAds->filter(function ($adv){
            return $adv->advertise_type == Advertise::TYPE_FOR_RENT;
        })->max('sell');
        $mr = $allAds->filter(function ($adv){
            return $adv->advertise_type == Advertise::TYPE_FOR_RENT;
        })->max('rent');

        if($request->max_price){
            $allAds = $allAds->filter(function ($adv) use ($request){
                return $adv->sell <= $request->max_price;
            });
            $max_sell = $request->max_price;
        }
        if($request->min_price){
            $allAds = $allAds->filter(function ($adv) use ($request){
                return $adv->sell <= $request->min_price;
            });
            $min_sell = $request->min_price;
        }

//        if($request->max_rent_price){
//            $allAds = $allAds->where('sell', '<=', $request->max_price);
//            $max_sell = $request->max_price;
//        }
//        if($request->min_rent_price){
//            $allAds = $allAds->where('sell', '=>', $request->min_price);
//            $min_sell = $request->min_price;
//        }
//
//        if($request->max_rent){
//            $allAds = $allAds->where('rent', '<=', $request->max_rent);
//            $max_rent = $request->max_rent;
//        }
//        if($request->min_rent) {
//            $allAds = $allAds->where('rent', '=>', $request->min_rent);
//            $min_rent = $request->min_rent;
//        }
//        dd(Advertise::paginate(5));
//        $ads = new LengthAwarePaginator($allAds, count(Advertise::all()), 10, $page, ['path' => 'http://127.0.0.1:8000/search','pageName' => 'page']);
        $ads = $allAds;
        dd($allAds);
        return view('main.search.search', compact('ads', 'states', 'cities', 'estate_types', 'st', 'ets', 'room_nums', 'rooms', 'properties', 'pids', 'msp', 'mrp', 'mr'));
    }
    public function search1(Request $request)
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
        $ads_buf = Advertise::orderBy('created_at', 'desc');
        $msp = $ads_buf->where('advertise_type', '=', Advertise::TYPE_FOR_SELL)->get()->max('sell');
        $mrp = $ads_buf->where('advertise_type', '=', Advertise::TYPE_FOR_RENT)->get()->max('sell');
        $mr = $ads_buf->where('advertise_type', '=', Advertise::TYPE_FOR_RENT)->get()->max('rent');
        $st = 'all';
        if($request->st == 'buy'){
            $st = 'buy';
            $ads->where('advertise_type', '=', Advertise::TYPE_FOR_SELL);
        }
        if($request->st == 'rent'){
            $st = 'rent';
            $ads->where('advertise_type', '=', Advertise::TYPE_FOR_RENT);
        }

        if($request->rooms){
            $ads->whereIn('room', $request->rooms);
        }
        if($request->ets){
            $ads->whereIn('estate_type_id', $request->ets);
        }
        if($request->state_id){
            $ads->where('state_id', '=', $request->state_id);
        }
        if($request->city_id){
            $ads->where('city_id', '=', $request->city_id);
        }
        if($request->props){
            $props = $request->props;
            $ads->whereHas('properties', function ($q) use($props){
                $q->whereIn('id', $props);
            });
        }
        $max_sell = $msp;
        $min_sell = 0;
        $max_rent_price = $mrp;
        $min_rent_price = 0;
        $max_rent = $mr;
        $min_rent = 0;
        if($request->max_price){
            $ads = $ads->filter(function ($adv) use ($request){
                return $adv->sell <= $request->max_price;
            });
            $max_sell = $request->max_price;
        }
        if($request->min_price){
            $ads = $ads->where('sell', '=>', $request->min_price);
            $min_sell = $request->min_price;
        }

        if($request->max_rent_price){
            $ads = $ads->where('sell', '<=', $request->max_price);
            $max_sell = $request->max_price;
        }
        if($request->min_rent_price){
            $ads = $ads->where('sell', '=>', $request->min_price);
            $min_sell = $request->min_price;
        }
        if($request->max_rent){
            $ads = $ads->where('rent', '<=', $request->max_rent);
            $max_rent = $request->max_rent;
        }
        if($request->min_rent) {
            $ads = $ads->where('rent', '=>', $request->min_rent);
            $min_rent = $request->min_rent;
        }
        $ads = $ads->paginate(10);
        return view('main.search.search', compact('ads', 'estate_types', 'ets', 'max_sell', 'min_sell', 'st', 'msp', 'mrp', 'states', 'cities', 'state', 'city', 'properties', 'pids', 'room_nums','rooms'));
    }
}
