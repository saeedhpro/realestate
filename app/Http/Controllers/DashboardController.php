<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AuthCheckMiddleware;
use http\Client\Curl\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    use Authenticatable;

    public function dashboard()
    {
        return view();
    }
}
