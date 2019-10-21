<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealEstateController extends Controller
{
    public function index()
    {
        $realestates = RealEstate::all();
        return $realestates;
    }
    public function show(int $id)
    {
        $realestate = RealEstate::find($id);
        if($realestate){
            $user = Auth::user();
            $advertises = $realestate->advertises()->paginate(10);
            $vrads = Advertise::where('want_vr_tour', '=', true)->get();
            return view('dashboard.realestate.show', compact('user', 'realestate', 'advertises', 'vrads'));
        } else {
            return view('main.404');
        }
    }

    public function edit(int $id)
    {
        $realestate = RealEstate::find($id);
        if($realestate){
            $user = Auth::user();
            $advertises = $realestate->advertises()->paginate(10);
            $vrads = Advertise::where('want_vr_tour', '=', true)->get();
            return view('dashboard.realestate.edit', compact('user', 'realestate', 'advertises', 'vrads'));
        } else {
            return view('main.404');
        }
    }
}
