<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\EstateType;
use App\Gallery;
use App\Http\Requests\EscrowAdvertiseRequest;
use App\Property;
use App\Settings;
use App\State;
use App\Upload;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdvertiseController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $settings = Settings::all()->first();
        view()->share('settings', $settings);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Advertise::all()->get();
    }
    /**
     * Display the specified resource.
     *
     * @param \App\Advertise $advertise
     * @return Response
     */
    public function show(int $id)
    {
        $advertise = Advertise::find($id);
        if ($advertise) {
            $similar_ads = Advertise::where('advertise_type', '=', $advertise->advertise_type)->inRandomOrder()->take(8)->get();
            return view('main.advertise.show', compact('advertise', 'similar_ads'));
        } else {
            return view('main.404');
        }
    }

    public function thumbnail(int $id)
    {
        $adv = Advertise::find($id);
        return $adv->thumbnail;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        if (Auth::user()) {
            /** @var Advertise $adv */
            $adv = Advertise::find($id);
            if ($adv) {
                return view('dashboard.advertise.edit');
            } else {
                return view('main.404');
            }
        } else {
            return view('auth.login');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Advertise $advertise
     * @return Response
     */
    public function destroy(int $id)
    {
        /** @var Advertise $adv */
        $adv = Advertise::find($id);
        $adv->is_active = false;
        $adv->save();
//        if ($adv->delete()) {
//            return response()->json(['message' => 'با موفقیت حذف شد!'], 200);
//        } else {
//            return response()->json(['message' => 'متاسفانه خطایی رخ داده است'], 400);
//        }
            return response()->json(['message' => 'با موفقیت حذف شد!'], 200);
    }

    public function createEscrow()
    {
        $estate_types = EstateType::all();
        $states = State::all();
        $props = Property::all();
        return \view('main.advertise.escrow', compact('estate_types', 'states', 'props'));
    }

    public function storeEscrow(EscrowAdvertiseRequest $request)
    {
        /** @var Settings $settings */
        $settings = Settings::all()->first();

        /** @var Advertise $advertise */
        $advertise = Advertise::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'estate_type_id' => $request->estate_type,
            'advertise_type' => $request->advertise_type,
            'title' => $request->title,
            'area' => $request->area,
            'room' => $request->room,
            'age' => $request->age,
            'description' => $request->description,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'address' => $request->address,
            'real_estate_id' => 1,
            'state_id' => $settings->state->id,
            'city_id' => $settings->city->id,
            'region_id' => $request->region_id,
            'is_active' => false,
            'is_pro' => false,
            'is_escrow' => true,
            'want_vr_tour' => $request->want_vr_tour == true,
            'has_elevator' => $request->has_elevator == true,
            'has_parking' => $request->has_parking == true,
            'unit' => $request->units,
            'in_floor' => $request->unit,
            'floor' => $request->floors,
            'unit_price' => (double) $request->sell / (double) $request->area,
            'sell' => $request->sell,
            'rent' => $request->rent
        ]);
        $advertise->save();

        $images_tmp = $request->images;
        $images = [];
        $thumbnail = null;
        foreach ($images_tmp as $index => $id){
            /** @var Upload $upload */
            $upload = Upload::find($id);
            /** @var Gallery $image */
            $image = Gallery::create([
                'advertise_id' => $advertise->id,
                'path' => $upload->path,
            ]);
            if($index == 0){
                $thumbnail = $upload->path;
            }
            $image->save();
            array_push($images, $image->id);
        }
        $props_tmp = $request->props;
        $props = [];
        foreach ($props_tmp as $prop){
            array_push($props, $prop);
        }
        if($thumbnail){
            $advertise->thumbnail = $thumbnail;
        }
        $advertise->properties()->sync($props);
        return $advertise;
    }
}
