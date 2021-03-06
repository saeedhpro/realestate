<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api')->get('/estate-types', 'ApiEstateTypesController@index');

Route::post('/upload/', 'UploadController@upload')->name('upload');
Route::post('/upload/tour', 'UploadController@uploadVrTour')->name('upload.vrtour');
Route::delete('/upload/tour/{id}/delete', 'UploadController@deleteVrTour')->name('upload.vrtour');
