<?php

use Illuminate\Support\Facades\Route;
 
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ClickController; 
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlackListController;

use App\Http\Controllers\Ajax\AjaxCartController;
use Illuminate\Support\Facades\Auth;
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
//Auth::routes();

//auth routes ******  

# login page route
Route::get('/', function () {
    
    
    if(Auth::user()  == null)
      return view('admin.login'); 
    else
    return redirect('home'); 


})->name('login');
# register page route
Route::get('/sginup',[AccountController::class,'register']);

Route::group(['prefix' => 'auth'], function () {
    # login function
    Route::post('/login',[AccountController::class,'login']);

    # sign up(regestration) function
    Route::post('/signup',[AccountController::class,'signup']);

});
Route::post('/signup',[AccountController::class,'signup']);
Route::get('logout',[AccountController::class,'logout']);
# logout route


//End auth routs. ******


//admin pages routes groupe 
Route::group([  'middleware' => 'auth'], function(){
    
    #edit user
    Route::get('/user/edit/{id}',[AccountController::class,'edit']);
    Route::get('/user/doctor',[AccountController::class,'doctor']);
    Route::get('/user/Pharmacies',[AccountController::class,'Pharmacies']);
    // Route::get('/user/doctor',[AccountController::class,'doctor']);
    Route::get('/BestDoctor/{id}','App\Http\Controllers\Admin\BestDoctorController@store');
    Route::get('/notification','App\Http\Controllers\Admin\notificationController@index');

    
    # home route
    Route::get('home', [HomeController::class,'index']);
    # user roles routes
    Route::resource('roles','App\Http\Controllers\Admin\UserRoleController');
    # users routes
    Route::resource('users','App\Http\Controllers\Admin\UserController');
    # orders routes
    Route::resource('orders','App\Http\Controllers\Admin\OrderController');
    # reservations routes
    Route::resource('reservations','App\Http\Controllers\Admin\ReservationController');
    # medicines routes
    Route::resource('medicines','App\Http\Controllers\Admin\MedicineController');
    # districts routes
    Route::resource('districts','App\Http\Controllers\Admin\DistrictController');
    # clicks routes
    Route::resource('clicks','App\Http\Controllers\Admin\ClickController');
    # cities routes
    Route::resource('cities','App\Http\Controllers\Admin\CityController');
    # cities routes 
    Route::resource('Appointments','App\Http\Controllers\Admin\AppointmentsController');
    // Black List routes
    Route::group(['prefix' => 'blacklist'], function (){
        # index route
        Route::get('index', [BlackListController::class,'index']);
        Route::get('block/{id}', [BlackListController::class,'block']);

    });

    
    // //push notification
    // Route::group(['prefix' => 'pushnotification'], function (){

    //     Route::get('/',[
    //         'as' => 'admin.pushnotification.get', 'uses' => 'App\Http\Controllers\Admin\PushNotificationController@index'
    //     ]);

    //     Route::post('/add',[
    //         'as' => 'admin.pushnotification.add', 'uses' => 'App\Http\Controllers\Admin\PushNotificationController@add'
    //     ]);

    // });

});


 



//errors pages routes

# sumething error
Route::get('/somethingwrong',function () { return view('admin.error.somethingwrong'); });
# parmitions error
Route::get('/unauthorized',function () { return view('admin.error.somethingwrong'); });
//End errors routes



// Route::group(['prefix' => 'cart'], function(){

    //  Route::get('/',[CartController::class,'index']);
    //  Route::get('/add/{id}',[CartController::class,'store']);
        
    // });

        # view login page route

    //Route::get('account', function () { return view('web.account.account'); });