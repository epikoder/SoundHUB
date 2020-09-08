<?php

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
//////////////// W E B /////////////////////////////////////////
Route::namespace('WEB')->domain(env('APP_URL'))->group(function () {
    Route::get('/', 'Routes\MediaController@indexRedirect')->name('home');
    Route::group(['prefix' => 'v1', 'middleware' => 'cors'], function () {
        /// Signup
        Route::get('/signup', 'Auth\AuthController@regSignupRoute')->name('signup/reg');
        Route::post('signup/reg', 'Auth\AuthController@regSignup')->name('signup.reg');
        Route::get('signup/res', 'Auth\AuthController@responseSignup')->name('signup/res');

        Route::group(['middleware' => 'regs'], function () {
            Route::get('signup/ver', 'Auth\AuthController@verSignup')->name('signup.ver');
            Route::post('signup', 'Auth\AuthController@signup')->name('signup.main');
        });

        // Login
        Route::post('login', 'Auth\AuthController@login')->name('login');
        Route::get('login', 'Auth\AuthController@loginRoute')->name('getLogin');
        Route::get('logout', 'Auth\AuthController@logout')->name('logout');

        // Payment
        Route::group(['prefix' => 'pay'], function () {

            Route::get('paystack/callback', 'Payment\PaymentController@handleGatewayCallback')->name('paystack.callback');
            Route::get('paystack/wh_z', 'Payment\PaymentController@handleGatewayWebhook')->name('paystack.webhook');
            Route::get('paystack/pay', 'Payment\PaymentController@payRoute')->name('paystack/pay');

            Route::group(['middleware' => 'auth'], function () {
                Route::get('plans', 'Routes\PayController@plans')->name('plans');
                Route::post('paystack/pay', 'Payment\PaymentController@redirectToGateway')->name('paystack.pay');
            });
        });

        // Media & User
        Route::group(['middleware' => ['auth']], function () {
            Route::get('setup', 'Routes\ArtistsController@setup')->name('setup');
            Route::post('query', 'Routes\ArtistsController@queryName')->name('queryName');
            Route::post('setup', 'Routes\ArtistsController@setupName')->name('.setup');
        });
        Route::group(['middleware' => ['auth', 'subs']], function () {
            Route::post('upload', 'Media\MediaManager@upload')->name('media.upload');
            Route::post('uploadBulk', 'Media\MediaManager@bulkUpload')->name('media.bulk');

            Route::get('/{name}/dashboard/social', 'Routes\ArtistsController@social')->name('dashboard.social');

            Route::get('/{name}/dashboard', 'Routes\ArtistsController@index')->name('dashboard/artists');
            Route::get('/{name}/dashboard/upload', 'Routes\MediaController@upload')->name('dashboard/upload');
            Route::get('/{name}/dashboard/ablum', 'Routes\MediaController@uploadAlbum')->name('dashboard/album');
            Route::get('/{name}/dashboard/media', 'Routes\MediaController@indexMedia')->name('dashboard/mediaindex');
            Route::get('/{name}/dashboard/password', 'Routes\ArtistsController@password')->name('dashboard/password');
            Route::get('/{name}/dashboard/picture', 'Routes\ArtistsController@picture')->name('dashboard/picture');
            Route::get('/{name}/dashboard/promo', 'Routes\ArtistsController@promo')->name('dashboard/promo');
            Route::get('/{name}/dashboard/promo_stats', 'Routes\ArtistsController@promostats')->name('dashboard/promostats');
        });

        // APP

        Route::get('/', 'Routes\MediaController@index')->name('home/v1');
        Route::get('/track/{artist}/{title}', 'Routes\MediaController@track')->name('track');
        Route::get('/album/{artist}/{album}', 'Routes\MediaController@album')->name('album');
        Route::get('/artists/{name}', 'Routes\MediaController@artist')->name('artist');
        //Route::get('/download/{type}/{artist}/{id}/{title}', 'Media\MediaManager@download')->name('download')->where('id', '[0-9]');

        Route::get('/support/suspended', 'Routes\ArtistsController@support')->name('support/suspended');
    });
    //////////////// W E B ////////////////////////////////

});


######################################################
################## Begin of Admin ####################
######################################################
Route::namespace('ADMIN')->domain('admin.' . env('APP_URL'))->group(function () {
    Route::get('/', 'Views@indexRedirect');
    Route::group(['prefix' => 'v1'], function () {
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
});
######################################################
############ End of Admin ############################
######################################################

/////////// DEV //////////////////////////////
Route::get('/up', 'DEV@up');
Route::get('/make', 'DEV@make');

