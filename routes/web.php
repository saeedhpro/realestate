<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Advertise;
use App\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Psy\Util\Json;

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/getmarkers', function (){
   return \response()->json(Advertise::all(['id', 'title', 'lat', 'lng']));
});
Route::resource('/adv', 'AdvertiseController');
Route::get('/adv/{id}/th', 'AdvertiseController@thumbnail')->name('thumbnail');
Route::resource('/tour', 'VrTourController');

Route::get('/search', 'SearchController@search')->name('search');
