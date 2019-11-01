<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\EstateType;
use App\Property;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Advertise::all()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Advertise $advertise
     * @return \Illuminate\Http\Response
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
     * @param \App\Advertise $advertise
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        if (Auth::user()) {
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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Advertise $advertise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Advertise $advertise
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $adv = Advertise::find($id);
        if ($adv->delete()) {
            return response()->json(['message' => 'با موفقیت حذف شد!'], 200);
        } else {
            return response()->json(['message' => 'متاسفانه خطایی رخ داده است'], 400);
        }
    }
}
