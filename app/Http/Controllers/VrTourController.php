<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\User;
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
        return view('dashboard.virtualtour.create');
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
        $adv = Advertise::find($id);
        $tour = $adv->tour;
        $path = '/vrtour/'.$tour->title.'/';
        $files = scandir(public_path($path));
        $src = '';
        if(count($files) > 3){
            if(file_exists(public_path($path.'/tour.html'))){
                $src = $path.'/tour.html';
            } else if(file_exists(public_path($path.'/index.html'))){
                $src = $path.'/index.html';
            }
        } else {
            foreach ($files as $file){
                if(file_exists(public_path($path.$file.'/tour.html'))){
                    $src = $path.$file.'/tour.html';
                } else if(file_exists(public_path($path.$file.'/index.html'))){
                    $src = $path.$file.'/index.html';
                }
            }
        }
        $realestate = User::where('type', '=', User::ADMIN)->first()->real_estate;
        return view('main.vrtour.show', compact('tour', 'src', 'realestate'));
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
