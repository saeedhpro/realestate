<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\EstateType;
use App\Gallery;
use App\Http\Middleware\AuthCheckMiddleware;
use App\Property;
use App\RealEstate;
use App\Upload;
use App\User;
use Dotenv\Validator;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    use Authenticatable;

    public function dashboard()
    {
        $user = Auth::user();
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        return view('dashboard.dashboardlayout', compact('user', 'vrads'));
    }

    public function showAdvertises()
    {
        $user = Auth::user();
        if($user ->type == User::USER){
            $advertises = Advertise::where('user_id', '=', $user->id);
        } else{
            $advertises = Advertise::where('real_estate_id', '=', $user->real_estate->id);
        }
        $advertises = $advertises->paginate(10);
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        return view('dashboard.advertise.index', compact('user', 'advertises', 'vrads'));
    }

    public function storeAdvertise(Request $request)
    {
        $advertise = Advertise::create([
            'estate_type_id' =>  $request->estate_type_id,
            'advertise_type' => $request->advertise_type,
            'title' => $request->title,
            'area' => $request->area,
            'room' => $request->room,
            'age' => $request->age,
            'description' => $request->description,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'want_vr_tour' => $request->want_vr_tour == "on",
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'sell' => $request->sell,
            'rent' => $request->rent,
        ]);
        $advertise->save();
        if($request->images) {
            foreach ($request->images as $image) {
                $upload = Upload::find($image);
                $gallery = Gallery::create([
                    'advertise_id' => $advertise->id,
                    'path' => $upload->path,
                ]);
                $gallery->save();
            }
        }
        if($request->props) {
            $advertise->properties->sync($request->props);
        }
        return $advertise;
    }
    public function updateAdvertise(Request $request, int $id)
    {
        $advertise = Advertise::find($id);
        if(!$advertise){
            return view('main.404');
        }
        $advertise->update([
            'estate_type_id' =>  $request->estate_type_id,
            'advertise_type' => $request->advertise_type,
            'title' => $request->title,
            'area' => $request->area,
            'room' => $request->room,
            'age' => $request->age,
            'description' => $request->description,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'sell' => $request->sell,
            'rent' => $request->rent,
        ]);
        if($request->want_vr_tour){
            $advertise->want_vr_tour = $request->want_vr_tour == "on";
        }
        $advertise->save();
        if($request->images) {
            foreach ($request->images as $image) {
                $upload = Upload::find($image);
                $gallery = Gallery::create([
                    'advertise_id' => $advertise->id,
                    'path' => $upload->path,
                ]);
                $gallery->save();
            }
        }
        if($request->props) {
            $advertise->properties->sync($request->props);
        }
        return $advertise;
    }

    public function showAdvertise(int $id)
    {

    }

    public function editAdvertise(int $id)
    {
        $user = Auth::user();
        $advertise = Advertise::find($id);
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        $props = Property::all();
        $estate_types = EstateType::all();
        if($advertise){
            return view('dashboard.advertise.edit', compact('advertise', 'user', 'vrads', 'props', 'estate_types'));
        }
        return view('main.404');
    }

    public function createAdvertise()
    {
        $user = Auth::user();
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        $estate_types = EstateType::all();
        $props = Property::all();
        return view('dashboard.advertise.create', compact('user', 'vrads', 'estate_types', 'props'));
    }

    public function destroyAdvertise(int $id)
    {
        return $id;
    }

    public function showEmployees()
    {
        $user = Auth::user();
        $employees = $user->real_estate->employees();
        dd($employees);
    }

    public function addVrTour(int $id)
    {
        return 'yes';
    }

    public function storeVrTour(int $id)
    {
        return 'no';
    }
}
