<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;

class RegionMarginController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $settings = Settings::all()->first();
        view()->share('settings', $settings);
    }
}
