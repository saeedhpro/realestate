<?php

namespace App\Http\Controllers;

use App\PropertyType;
use App\Settings;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
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
     * @param  \App\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyType $propertyType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyType $propertyType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyType $propertyType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyType $propertyType)
    {
        //
    }
}
