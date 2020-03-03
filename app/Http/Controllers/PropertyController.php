<?php

namespace App\Http\Controllers;

use App\Property;
use App\Settings;
use Illuminate\Http\Request;

class PropertyController extends Controller
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
        $property = Property::firstOrCreate($request->all());
        return $property;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return Property
     */
    public function update(Request $request, Property $property)
    {
        $property->update($request->all());
        return $property;
    }


    public function delete(Request $request, Property $property)
    {
        if($property){
            try{
                $property->delete();
            } catch (\Exception $exception){
                response()->json(['success' => false, 'message' => 'یافت نشد!'], 404);
            }
        } else {
            response()->json(['success' => false, 'message' => 'یافت نشد!'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }
}
