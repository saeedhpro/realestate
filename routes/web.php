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
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Psy\Util\Json;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', function (){
    return redirect()->route('home');
});
Auth::routes();

Route::get('/getmarkers', function (){
   return \response()->json(Advertise::all(['id', 'title', 'lat', 'lng']));
});
Route::resource('/adv', 'AdvertiseController');
Route::get('/adv/{id}/th', 'AdvertiseController@thumbnail')->name('thumbnail');
Route::resource('/tour', 'VrTourController');

Route::get('/search', 'SearchController@search')->name('search');

Route::get('/states/{id}/cities', 'StateController@cities');

Route::prefix('/upload/')->group(function (){
    Route::post('/', 'UploadController@upload')->name('upload');
    Route::delete('/{id}/delete', 'UploadController@destroy')->middleware('auth')->name('upload.destroy');
});

Route::middleware('auth')->group(function (){
    Route::prefix('/dashboard/')->group(function (){
        Route::get('/', 'DashboardController@dashboard')->name('dashboard');

        Route::prefix('advertise')->group(function (){
            Route::get('/', 'DashboardController@showAdvertises')->name('dashboard.advertise.index');
            Route::post('/', 'DashboardController@storeAdvertise')->name('dashboard.advertise.store');
            Route::get('/create', 'DashboardController@createAdvertise')->name('dashboard.advertise.create');
            Route::get('/{id}', 'DashboardController@showAdvertise')->name('dashboard.advertise.show');
            Route::delete('/{id}', 'DashboardController@destroyAdvertise')->name('dashboard.advertise.destroy');
            Route::put('/{id}', 'DashboardController@updateAdvertise')->name('dashboard.advertise.update');
            Route::get('/{id}/edit', 'DashboardController@editAdvertise')->name('dashboard.advertise.edit');
            Route::get('/{id}/vrtour', 'DashboardController@addVrTour')->name('dashboard.advertise.vrtour.add');
            Route::post('/{id}/vrtour', 'DashboardController@storeVrTour')->name('dashboard.advertise.vrtour.store');
        });

        Route::resource( '/profile', 'UserController');

        Route::resource('/realestate', 'RealEstateController');
        Route::prefix('/realestate/{id}/employees')->group(function (){
            Route::get('/', 'DashboardController@showEmployees')->name('dashboard.realestate.employee.index');
        });
    });
});
