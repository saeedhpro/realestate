<?php

namespace App\Http\Controllers;

use App\EstateType;
use App\Settings;
use Illuminate\Http\Request;

class ApiEstateTypesController extends Controller
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
     * @return EstateType[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return EstateType::all();
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
     * @return EstateType
     */
    public function store(Request $request)
    {
        $et = new EstateType($request->all());
        $et->save();
        return $et;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return EstateType::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $et = EstateType::find($id);
        if($et){
            $et->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $et = EstateType::find($id);
        if($et->delete()){
            return response()->json(['message'=>'انجام شد'], 202);
        }
    }
}
