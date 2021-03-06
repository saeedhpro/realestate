<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\Property;
use App\Settings;
use App\State;
use App\User;
use Cassandra\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $settings = Settings::all()->first();
        view()->share('settings', $settings);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $settings = Settings::all()->first();
        $user = Auth::user();
        $vrads = Advertise::where('want_vr_tour', '=', true)->get();
        $users = User::all();
        $states = State::all();
        $properties = Property::all();
        return view('dashboard.settings.settings', compact( 'user', 'users', 'vrads', 'states', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $settings = Settings::all()->first();
        $settings->update([
            'name' => $request->name,
            'map_api' => $request->map_api,
            'news_api' => $request->news_api,
            'admin_id' => $request->admin_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'about' => $request->about,
            'logo_id' => $request->logo_id,
        ]);
        return $settings;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
