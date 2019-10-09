<?php

namespace App\Http\Controllers;

use App\VrTour;
use Illuminate\Http\Request;

class VrTourController extends Controller
{
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
     * @param  \App\VrTour  $vrTour
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $tour = VrTour::find($id);
        dd($tour->path);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VrTour  $vrTour
     * @return \Illuminate\Http\Response
     */
    public function edit(VrTour $vrTour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VrTour  $vrTour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VrTour $vrTour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VrTour  $vrTour
     * @return \Illuminate\Http\Response
     */
    public function destroy(VrTour $vrTour)
    {
        //
    }
}
