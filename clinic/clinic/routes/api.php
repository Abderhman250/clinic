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
Route::group(['middleware' => ['api','Public_key','Lang']], function () {
    Route::post('login', 'App\Http\Controllers\api\UserApiController@login');
    Route::post('registers', 'App\Http\Controllers\api\UserApiController@store');

    Route::get('City/all', 'App\Http\Controllers\api\LocationController@index');
    Route::get('District/all', 'App\Http\Controllers\api\LocationController@index2');
    Route::get('location/all', 'App\Http\Controllers\api\LocationController@location');

    Route::get('location/find', 'App\Http\Controllers\api\LocationController@locationShow');
    Route::get('locationWithCity', 'App\Http\Controllers\api\LocationController@locationWithCity');
    Route::get('CityAarry', 'App\Http\Controllers\api\LocationController@CityAarry');
    Route::get('FindDistrict', 'App\Http\Controllers\api\LocationController@FindDistrict');

    
    Route::get('Doctor/all', 'App\Http\Controllers\api\DoctorController@index');
    Route::get('Doctor/show', 'App\Http\Controllers\api\DoctorController@show');
    Route::get('Doctor/show', 'App\Http\Controllers\api\DoctorController@show');
    Route::get('Doctor/serch', 'App\Http\Controllers\api\DoctorController@serch');
    Route::get('/bestDoctor', 'App\Http\Controllers\api\DoctorController@BestDoctor');

    
   
    Route::get('Reservation/show', 'App\Http\Controllers\api\ReservationController@index');
    Route::post('Reservation/store', 'App\Http\Controllers\api\ReservationController@store');
    Route::get('GetSavenDate', 'App\Http\Controllers\api\AppointmentsController@GetSavenDate');
  

    Route::group(['middleware' => ['check_Auth_API']], function () {

        Route::put('Click/count', 'App\Http\Controllers\api\clickController@create');
        Route::post('Appointments/new', 'App\Http\Controllers\api\AppointmentsController@store');
        Route::get('Appointments/show', 'App\Http\Controllers\api\AppointmentsController@show');

    });
});
