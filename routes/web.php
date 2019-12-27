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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', function (){
    return redirect()->route('home');
});
Auth::routes();
Route::get('/getmarkers', function (){
   return \response()->json(Advertise::all(['id', 'title', 'lat', 'lng']));
});
Route::resource('/adv', 'AdvertiseController');
Route::get('/adv/{id}/tour', 'VrTourController@show')->name('advertise.tour');
Route::get('/adv/{id}/th', 'AdvertiseController@thumbnail')->name('thumbnail');
//Route::resource('/tour', 'VrTourController');

Route::prefix('/new')->group(function (){
    Route::get('/', 'AdvertiseController@createEscrow')->name('advertise.escrow.create');
    Route::post('/', 'AdvertiseController@storeEscrow')->name('advertise.escrow.store');
});

Route::get('/search', 'SearchController@search')->name('search');
Route::get('/latest', 'SearchController@latest')->name('latest');
Route::post('/searchAjax', 'SearchController@searchAjax')->name('searchAjax');

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
            Route::get('/search', 'SearchController@dashboardSearch')->name('dashboard.advertise.search');
            Route::get('/{id}', 'DashboardController@showAdvertise')->name('dashboard.advertise.show');
            Route::delete('/{id}', 'DashboardController@destroyAdvertise')->name('dashboard.advertise.destroy');
            Route::put('/{id}', 'DashboardController@updateAdvertise')->name('dashboard.advertise.update');
            Route::get('/{id}/edit', 'DashboardController@editAdvertise')->name('dashboard.advertise.edit');
            Route::get('/{id}/vrtour', 'DashboardController@createVrTour')->name('dashboard.advertise.vrtour.create');
            Route::post('/{id}/vrtour', 'DashboardController@storeVrTour')->name('dashboard.advertise.vrtour.store');
            Route::delete('/{id}/gallery/{gallery_id}/delete', 'DashboardController@destroyGallery')->name('dashboard.advertise.gallery.destroy');
        });

        Route::resource( '/profile', 'UserController');

        Route::resource('/realestate', 'RealEstateController');
        Route::delete('/realestate/{id}/avatar/delete', 'RealEstateController@deleteAvatar')->name('dashboard.realestate.avatar.delete');
        Route::prefix('/realestate/{id}/employees')->group(function (){
            Route::get('/', 'DashboardController@showEmployees')->name('dashboard.realestate.employee.index');
            Route::post('/', 'DashboardController@storeEmployee')->name('dashboard.realestate.employee.store');
            Route::get('/create', 'DashboardController@createEmployee')->name('dashboard.realestate.employee.create');
            Route::get('/{eid}', 'DashboardController@showEmployee')->name('dashboard.realestate.employee.show');
            Route::post('/{eid}', 'DashboardController@updateEmployee')->name('dashboard.realestate.employee.update');
            Route::get('/{eid}/edit', 'DashboardController@editEmployee')->name('dashboard.realestate.employee.edit');
            Route::post('/{eid}/avatar/delete', 'DashboardController@deleteAvatar')->name('dashboard.realestate.employee.avatar.delete');
        });
        Route::get('/settings/', 'SettingsController@edit')->name('dashboard.settings.edit');
        Route::post('/settings/', 'SettingsController@update')->name('dashboard.settings.update');
    });
});

Route::get('/compares', 'HomeController@compares')->name('compares');

Route::get('/test', function (){
    $res = \App\Helpers\normalPrice(16000000, 120, 1398, 1, 4, 5, 2, false, true);
    return $res;
});
