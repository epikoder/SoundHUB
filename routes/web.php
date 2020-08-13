<?php

use App\Http\Middleware\Regs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
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


//////////////// W E B /////////////////////////////////////////
Route::namespace('WEB')->domain(env('APP_URL'))->group(function () {
    /// Signup
    Route::get('/signup', 'Auth\AuthController@regSignupRoute')->name('signup/reg');
    Route::post('signup/reg', 'Auth\AuthController@regSignup')->name('signup.reg');
    Route::group(['middleware' => 'regs'], function () {
        Route::get('signup/ver', 'Auth\AuthController@verSignup')->name('signup.ver');
        Route::post('signup', 'Auth\AuthController@signup')->name('signup.main');
    });

    // Login
    Route::post('login', 'Auth\AuthController@login')->name('login');
    Route::get('login', 'Auth\AuthController@loginRoute')->name('getLogin');

    // Payment
    Route::group(['prefix' => 'pay'], function () {
        Route::get('paystack/callback', 'Payment\PaymentController@handleGatewayCallback')->name('paystack.callback');

        Route::group(['middleware' => 'auth'], function () {
            Route::post('paystack/pay', 'Payment\PaymentController@redirectToGateway')->name('paystack.pay');
        });
    });

    // Media & User
    Route::group(['middleware' => ['auth',]], function () {
        Route::post('upload', 'Media\MediaManager@upload')->name('media.upload');
        Route::post('uploadBulk', 'Media\MediaManager@bulkUpload')->name('media.bulk');
        
        Route::post('/{name}/dashboard/social', 'Routes\ArtistsController@social')->name('dashboard.social');
        Route::post('/{name}/dashboard/about', 'Routes\ArtistsController@about')->name('dashboard.about');

        Route::get('/{name}/home', 'Routes\UserController@index')->name('dashboard/user');
        Route::get('/{name}/dashboard', 'Routes\ArtistsController@index')->name('dashboard/artists');
        Route::get('/{name}/dashboard/upload', 'Routes\MediaController@upload')->name('dashboard/upload');
        Route::get('/{name}/dashboard/ablum', 'Routes\MediaController@album')->name('dashboard/album');
        Route::get('/{name}/dashboard/media', 'Routes\MediaController@indexMedia')->name('dashboard/mediaindex');
        Route::get('/{name}/dashboard/password', 'Routes\ArtistsController@password')->name('dashboard/password');
        Route::get('/{name}/dashboard/picture', 'Routes\ArtistsController@picture')->name('dashboard/picture');
        Route::get('/{name}/dashboard/promo', 'Routes\ArtistsController@promo')->name('dashboard/promo');
        Route::get('/{name}/dashboard/promo_stats', 'Routes\ArtistsController@promostats')->name('dashboard/promostats');
    });


    Route::get('/', 'Routes\MediaController@index')->name('home');
});
//////////////// W E B ////////////////////////////////

######################################################
################## Begin of Admin ####################
######################################################

Route::namespace('ADMIN')->domain('admin.' . env('APP_URL'))->group(function () {

    // Login
    Route::get('/', 'Views@index')->name('login/admin');
    Route::post('login', 'Admin@login')->name('login.admin');

    Route::group(['middleware' => ['auth', 'admin']], function () {

        // Media Upload
        Route::post('upload', 'Media\MediaManager@upload')->name('admin.upload');
        Route::post('uploadBulk', 'Media\MediaManager@bulkUpload')->name('admin.uploadBulk');

        Route::get('/dashboard', 'Views@dashboard')->name('Admin/dashboard');
        Route::get('/media', 'Views@media')->name('media/admin');
        Route::get('/media.{path}', 'Views@mediaLinks')->name('media.links');
    });
});
######################################################
############ End of Admin ############################
######################################################


/////////// DEV //////////////////////////////
Route::get('/up', 'DEV@up');
Route::get('/make', 'DEV@make');

