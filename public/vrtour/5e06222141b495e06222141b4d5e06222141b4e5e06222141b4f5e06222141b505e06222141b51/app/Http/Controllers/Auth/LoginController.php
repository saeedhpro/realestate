<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request['remember-me'] = $request->rememberme;
        $validate = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember-me' => ['boolean'],
        ]);
        if($validate->validate()) {
            $credentials = $request->only('email', 'password');
            $remember_token = $request->rememberme_me;
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember_token)) {
                return response()->json(['message' => 'ورود با موفقیت انجام شد!', 'url' => $request->url], 200);
            } else {
                return response()->json(['message' => 'کاربری با این مشخصات پیدا نشد!', 'errors' => ['user' => 'کاربری با این مشخصات پیدا نشد!']], 422);
            }
        } else {
            return $validate->errors();
        }
    }
}
