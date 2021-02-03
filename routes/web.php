<?php

use Illuminate\Support\Facades\Config;
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
Route::namespace('WEB')->group(function () {
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

            Route::group(['middleware' => 'auth'], function () {
                Route::get('info', 'Routes\PayController@plans')->name('pay/info');
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
        });

        // APP
        Route::get('/', 'Routes\MediaController@index')->name('home/v1');

        Route::get('browse', 'Routes\MediaController@browse')->name('browse');
        Route::get('/play', 'Routes\MediaController@play')->name('play');
        Route::get('/songs/{artist}', 'Routes\MediaController@allArtistTracks')->name('all/artist/track');
        Route::get('/songs/{artist}/{slug}', 'Routes\MediaController@tracks')->name('track');

        Route::get('/albums/{artist}', 'Routes\MediaController@allArtistAlbums')->name('all/artist/album');
        Route::get('/albums/{artist}/{slug}', 'Routes\MediaController@albums')->name('album');

        Route::get('/artists', 'Routes\MediaController@allArtists')->name('all/artist');
        Route::get('/artists/{name}', 'Routes\MediaController@artists')->name('artist');

        Route::get('search', 'Routes\MediaController@search')->name('search');
    });
    //////////////// W E B ////////////////////////////////

});


######################################################
################## Begin of Admin ####################
######################################################
Route::namespace('ADMIN')->prefix('admin')->group(function () {
    Route::get('/', 'Views@indexRedirect');
    Route::group(['prefix' => 'v1'], function () {
        // Login
        Route::get('/', 'Views@index')->name('login/admin');
        Route::post('login', 'Admin@login')->name('login.admin');
        Route::get('logout', 'Admin@logout')->name('logout.admin');

        Route::group(['middleware' => ['auth', 'admin']], function () {
            //Artist & User
            Route::post('/dashboard/user/create', 'Root\UserManager@createUser')->name('create.user');
            Route::post('/dashboard/artist/create', 'Root\UserManager@createArtist')->name('create.artist');

            // Media Upload
            Route::post('upload', 'Media\MediaManager@upload')->name('admin.upload');
            Route::post('uploadBulk', 'Media\MediaManager@bulkUpload')->name('admin.uploadBulk');

            Route::get('/dashboard', 'Views@dashboard')->name('Admin/dashboard');
            Route::get('/media', 'Views@media')->name('Admin/media');
            Route::get('/media.{path}', 'Views@mediaLinks')->name('media.links');
        });
    });
});
######################################################
############ End of Admin ############################
######################################################
