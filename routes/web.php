<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/////////// BEGIN OF CONTROLLER ROUTE ////////////////////
Route::namespace('API')->group(function () {
    Route::group(['middleware' => 'regs'], function () {
        Route::get('signup/ver', 'Auth\AuthController@verSignup')->name('signup.ver');
        Route::post('signup', 'Auth\AuthController@signup')->name('signup.main');
    });
    Route::post('signup/reg', 'Auth\AuthController@regSignup')->name('signup.reg');
    Route::post('login', 'Auth\AuthController@login')->name('login');

    Route::group(['prefix' => 'pay'], function () {
        Route::group(['middleware' => 'auth'], function () {
            Route::post('paystack/pay', 'Payment\PaymentController@redirectToGateway')->name('paystack.pay');
        });
        Route::get('paystack/callback', 'Payment\PaymentController@handleGatewayCallback')->name('paystack.callback');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::post('upload', 'Media\MediaManager@upload')->name('media.upload');
    });
});

///////////// END OF CONTROLLER ROUTE ////////////////////////

///////////// BEGIN OF VIEW ROUTE ?///////////////////////////
Route::namespace('API')->group(function () {
    Route::get('/', 'Routes\MediaController@index')->name('home');

    Route::get('/signup', function () {
        return view('signup.signup-reg');
    })->name('signup/reg');

    Route::get('login', function () {
        return view('login');
    });

    Route::group(['middleware' => ['auth',]], function () {
        Route::get('/{name}/home', 'Routes\UserController@index')->name('dashboard/user');
        Route::get('/{name}/dashboard', 'Routes\ArtistsController@index')->name('dashboard/artists');
        Route::post('/{name}/dashboard/social', 'Routes\ArtistsController@uSocial')->name('dashboard/social');
        Route::get('/{name}/dashboard/upload', 'Routes\MediaController@upload')->name('dashboard/upload');
        Route::get('/{name}/dashboard/ablum', 'Routes\MediaController@album')->name('dashboard/album');
        Route::get('/{name}/dashboard/media', 'Routes\MediaController@indexMedia')->name('dashboard/mediaindex');
    });

    Route::get('400', function(){
        return view('errors.400');
    })->name('400');
});

//////////////////////////////////////////////

/////////// DEV //////////////////////////////
Route::get('/up', function () {
    $user = new User(
        [
            'name' => 'Efedua Believe',
            'email' => 'efedua.bell@gmail.com',
            'password' => bcrypt('beLL1923')
        ]
        ); $user->save();
    $user->artists()->create([
        'name' => 'Mr Bell'
    ]);
});
Route::get('/devlogin', function () {
    return view('logindev');
});
Route::post('/devlogin', 'API\Auth\AuthController@login')->name('devlogin');
