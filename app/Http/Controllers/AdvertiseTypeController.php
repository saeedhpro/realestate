<?php

namespace App\Http\Controllers;

use App\AdvertiseType;
use App\Settings;
use Illuminate\Http\Request;

class AdvertiseTypeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdvertiseType  $advertiseType
     * @return \Illuminate\Http\Response
     */
    public function show(AdvertiseType $advertiseType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdvertiseType  $advertiseType
     * @return \Illuminate\Http\Response
     */
    public function edit(AdvertiseType $advertiseType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdvertiseType  $advertiseType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdvertiseType $advertiseType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdvertiseType  $advertiseType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdvertiseType $advertiseType)
    {
        //
    }
}
