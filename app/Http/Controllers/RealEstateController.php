<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\RealEstate;
use App\Settings;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealEstateController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $settings = Settings::all()->first();
        view()->share('settings', $settings);
    }
    public function index()
    {
        $user = Auth::user();
        if($user->type != User::ADMIN){
            return redirect()->route('dashboard');
        }
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        $realestates = RealEstate::paginate(10);
        return view('dashboard.realestate.index', compact('realestates', 'user', 'vrads'));
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

    public function deleteAvatar(int $id)
    {
        $realestate = RealEstate::find($id);
        if(!$realestate){
            return view('main.404');
        }

    }
}
