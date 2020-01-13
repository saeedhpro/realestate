<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\Settings;
use App\User;
use App\VrTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VrTourController extends Controller
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
        $hasVrTour = false;
        if(count($files) > 3){
            if(file_exists(public_path($path.'/tour.html'))){
                $src = $path.'/tour.html';
                $hasVrTour = true;
            } else if(file_exists(public_path($path.'/index.html'))){
                $src = $path.'/index.html';
                $hasVrTour = true;
            }
        } else {
            foreach ($files as $file){
                if(file_exists(public_path($path.$file.'/tour.html'))){
                    $src = $path.$file.'/tour.html';
                    $hasVrTour = true;
                } else if(file_exists(public_path($path.$file.'/index.html'))){
                    $src = $path.$file.'/index.html';
                    $hasVrTour = true;
                }
            }
            $hasVrTour = true;
        }
        if ($hasVrTour){
            $realestate = User::where('type', '=', User::ADMIN)->first()->real_estate;
            return view('main.vrtour.show', compact('tour', 'src', 'realestate'));
        } else {
            return redirect()->back();
        }
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
