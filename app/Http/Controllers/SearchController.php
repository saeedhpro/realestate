<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\EstateType;
use App\Property;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use function Sodium\add;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $page = $request->has('page') && is_int($request->page) && $request->page >= 1 ? $request->page : null;
        $perPage = 10;
        $options = ['path' => route('search')];
        /** @var Advertise $ads */
        $allAds = Advertise::orderBy('created_at', 'desc')->get();
        $st = 'all';
        if($request->has('st')){
            if(in_array($request->st, ['all', 'buy', 'rent']) ){
                $st = $request->st;
            }
            if($st == 'buy'){
                $allAds = $allAds->filter(function ($adv){
                    /** @var Advertise $adv */
                    return $adv->advertise_type == Advertise::TYPE_FOR_SELL;
                });
            } elseif($st == 'rent'){
                $allAds = $allAds->filter(function ($adv){
                    /** @var Advertise $adv */
                    return $adv->advertise_type == Advertise::TYPE_FOR_RENT;
                });
            }
        }

        $estate_types = EstateType::all();
        $ets = [];
        if($request->has('ets')){
            if(is_array($request->ets)){
                $temp = $request->ets;
                foreach ($temp as $et){
                    if((int)$et > 0) {
                        array_push($ets, $et);
                    }
                }
            }
        }
        if(count($ets) > 0){
            $allAds = $allAds->filter(function ($adv) use ($ets){
                return in_array($adv->estate_type_id, $ets);
            });
        }
        $room_nums = Advertise::all()->sortBy('room')->unique('room');
        $rooms = [];
        if($request->has('rooms')){
            if(is_array($request->rooms)) {
                $temp = $request->rooms;
                foreach ($temp as $room) {
                    if((int)$room > 0) {
                        array_push($rooms, $room);
                    }
                }
            }
        }
        if(count($rooms) > 0) {
            $allAds = $allAds->filter(function ($adv) use ($rooms) {
                return in_array($adv->room, $rooms);
            });
        }
        $properties = Property::all();
        $pids = [];
        if($request->has('pids')){
            if(is_array($request->pids)) {
                $temp = $request->pids;
                foreach ($temp as $pid) {
                    if((int)$pid > 0) {
                        array_push($pids, $pid);
                    }
                }
            }
        }
        if(count($pids) > 0){
            $allAds = $allAds->filter(function ($adv) use ($pids){
                foreach ($adv->properties()->get() as $p){
                    return in_array($p->id, $pids);
                }
            });
        }

        $msp = Advertise::all()->where('advertise_type', '=',Advertise::TYPE_FOR_SELL)->max('sell');
        $mspr = Advertise::all()->where('advertise_type', '=',Advertise::TYPE_FOR_RENT)->max('sell');
        $msr = Advertise::all()->where('advertise_type', '=',Advertise::TYPE_FOR_RENT)->max('rent');

        $pbpaf = 0;
        $pbpat = $msp;
        $prpaf = 0;
        $prpat = $mspr;
        $praf = 0;
        $prat = $msr;


        if($request->has('pbpaf')){
            if(is_numeric($request->pbpaf) && $request->pbpaf <= $msp){
                $pbpaf = $request->pbpaf;
            }
        }
        if($request->has('pbpat')){
            if(is_numeric($request->pbpat) && $request->pbpat >= $pbpaf){
                $pbpat = $request->pbpat;
            }
        }

        switch ($st){
            case 'all':
                $allAds = $allAds->filter(function ($adv) use($pbpaf, $pbpat, $prpaf, $prpat, $praf, $prat){
                    /** @var Advertise $adv */
                    return $adv->advertise_type == Advertise::TYPE_FOR_SELL ? $adv->sell >= $pbpaf && $adv->sell <= $pbpat : $adv->sell >= $prpaf && $adv->sell <= $prpat && $adv->rent >= $praf && $adv->rent <= $prat;
                });
                break;
            case 'buy':
                $allAds = $allAds->filter(function ($adv) use($pbpaf, $pbpat){
                    /** @var Advertise $adv */
                    return $adv->advertise_type == Advertise::TYPE_FOR_SELL ? $adv->sell >= $pbpaf && $adv->sell <= $pbpat : false;
                });
                break;
            case 'rent':
                $allAds = $allAds->filter(function ($adv) use($prpaf, $prpat, $praf, $prat){
                    /** @var Advertise $adv */
                    return $adv->advertise_type == Advertise::TYPE_FOR_RENT ? $adv->sell >= $prpaf && $adv->sell <= $prpat && $adv->rent >= $praf && $adv->rent <= $prat : false;
                });
                break;
        }


        $ads = $this->paginate($allAds, $perPage, $page, $options);
        return view('main.search.search', compact('ads', 'st', 'estate_types', 'ets', 'room_nums', 'rooms', 'properties', 'pids', 'msp', 'pbpaf', 'pbpat', 'mspr', 'prpaf', 'prpat', 'msr', 'praf', 'prat'));
    }

    public function dashboardSearch(Request $request)
    {
        $page = $request->has('page') && is_int($request->page) && $request->page >= 1 ? $request->page : null;
        $perPage = 10;
        $options = ['path' => route('dashboard.advertise.search')];
        /** @var User $user */
        $user = Auth::user();
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        $ares = null;
        if($request->ares == "on"){
            $ares = $request->ares;
            $allAds = Advertise::orderBy('created_at', 'desc')->get();
        } else {
            $allAds = Advertise::where('real_estate_id', '=', $user->real_estate->id)->orderBy('created_at', 'desc')->get();
        }
        /** @var Advertise $ads */
        $st = 'all';
        if($request->has('st')){
            if(in_array($request->st, ['all', 'buy', 'rent']) ){
                $st = $request->st;
            }
            if($st == 'buy'){
                $allAds = $allAds->filter(function ($adv){
                    /** @var Advertise $adv */
                    return $adv->advertise_type == Advertise::TYPE_FOR_SELL;
                });
            } elseif($st == 'rent'){
                $allAds = $allAds->filter(function ($adv){
                    /** @var Advertise $adv */
                    return $adv->advertise_type == Advertise::TYPE_FOR_RENT;
                });
            }
        }

        $estate_types = EstateType::all();
        $ets = [];
        if($request->has('ets')){
            if(is_array($request->ets)){
                $temp = $request->ets;
                foreach ($temp as $et){
                    if((int)$et > 0) {
                        array_push($ets, $et);
                    }
                }
            }
        }
        if(count($ets) > 0){
            $allAds = $allAds->filter(function ($adv) use ($ets){
                return in_array($adv->estate_type_id, $ets);
            });
        }
        $room_nums = Advertise::all()->sortBy('room')->unique('room');
        $rooms = [];
        if($request->has('rooms')){
            if(is_array($request->rooms)) {
                $temp = $request->rooms;
                foreach ($temp as $room) {
                    if((int)$room > 0) {
                        array_push($rooms, $room);
                    }
                }
            }
        }
        if(count($rooms) > 0) {
            $allAds = $allAds->filter(function ($adv) use ($rooms) {
                return in_array($adv->room, $rooms);
            });
        }
        $properties = Property::all();
        $pids = [];
        if($request->has('pids')){
            if(is_array($request->pids)) {
                $temp = $request->pids;
                foreach ($temp as $pid) {
                    if((int)$pid > 0) {
                        array_push($pids, $pid);
                    }
                }
            }
        }
        if(count($pids) > 0){
            $allAds = $allAds->filter(function ($adv) use ($pids){
                foreach ($adv->properties()->get() as $p){
                    return in_array($p->id, $pids);
                }
            });
        }

        $msp = Advertise::all()->where('advertise_type', '=',Advertise::TYPE_FOR_SELL)->max('sell');
        $mspr = Advertise::all()->where('advertise_type', '=',Advertise::TYPE_FOR_RENT)->max('sell');
        $msr = Advertise::all()->where('advertise_type', '=',Advertise::TYPE_FOR_RENT)->max('rent');

        $pbpaf = 0;
        $pbpat = $msp;
        $prpaf = 0;
        $prpat = $mspr;
        $praf = 0;
        $prat = $msr;


        if($request->has('pbpaf')){
            if(is_numeric($request->pbpaf) && $request->pbpaf <= $msp){
                $pbpaf = $request->pbpaf;
            }
        }
        if($request->has('pbpat')){
            if(is_numeric($request->pbpat) && $request->pbpat >= $pbpaf){
                $pbpat = $request->pbpat;
            }
        }

        switch ($st){
            case 'all':
                $allAds = $allAds->filter(function ($adv) use($pbpaf, $pbpat, $prpaf, $prpat, $praf, $prat){
                    /** @var Advertise $adv */
                    return $adv->advertise_type == Advertise::TYPE_FOR_SELL ? $adv->sell >= $pbpaf && $adv->sell <= $pbpat : $adv->sell >= $prpaf && $adv->sell <= $prpat && $adv->rent >= $praf && $adv->rent <= $prat;
                });
                break;
            case 'buy':
                $allAds = $allAds->filter(function ($adv) use($pbpaf, $pbpat){
                    /** @var Advertise $adv */
                    return $adv->advertise_type == Advertise::TYPE_FOR_SELL ? $adv->sell >= $pbpaf && $adv->sell <= $pbpat : false;
                });
                break;
            case 'rent':
                $allAds = $allAds->filter(function ($adv) use($prpaf, $prpat, $praf, $prat){
                    /** @var Advertise $adv */
                    return $adv->advertise_type == Advertise::TYPE_FOR_RENT ? $adv->sell >= $prpaf && $adv->sell <= $prpat && $adv->rent >= $praf && $adv->rent <= $prat : false;
                });
                break;
        }
        $advertises = $this->paginate($allAds, $perPage, $page, $options);
        return view('dashboard.search.search', compact('advertises', 'user', 'vrads', 'estate_types', 'ares'));
    }
    private function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
