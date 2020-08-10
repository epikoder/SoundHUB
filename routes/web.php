<?php

use App\User;
use Illuminate\Http\Request;
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
    //////////////////////////////////////////////////////////////
    /////////// BEGIN OF WEB CONTROLLER ROUTE ////////////////////
    ///////////////////////////////////////////////////////////////
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


    /////////////////////////////////////////////////////////////
    ///////////// END OF CONTROLLER ROUTE ////////////////////////
    ////////////////////////////////////////////////////////////////


    /////////////WEB BEGIN OF VIEW ROUTE ?///////////////////////////
    Route::get('/', 'Routes\MediaController@index')->name('home');

    Route::get('/signup', function (Request $request) {
        return view('signup.signup-reg', [
            'user' => $request->user()
            ]);
    })->name('signup/reg');

    Route::get('login', function () {
        return view('login');
    });

    Route::group(['middleware' => ['auth',]], function () {
        Route::get('/{name}/home', 'Routes\UserController@index')->name('dashboard/user');
        Route::get('/{name}/dashboard', 'Routes\ArtistsController@index')->name('dashboard/artists');
        Route::get('/{name}/dashboard/upload', 'Routes\MediaController@upload')->name('dashboard/upload');
        Route::get('/{name}/dashboard/ablum', 'Routes\MediaController@album')->name('dashboard/album');
        Route::get('/{name}/dashboard/media', 'Routes\MediaController@indexMedia')->name('dashboard/mediaindex');
        Route::get('/{name}/dashboard/password', 'Routes\ArtistsController@password')->name('dashboard/password');
        Route::get('/{name}/dashboard/picture', 'Routes\ArtistsController@picture')->name('dashboard/picture');
        Route::get('/{name}/dashboard/promo', 'Routes\ArtistsController@promo')->name('dashboard/promo');
        Route::get('/{name}/dashboard/promo_stats', 'Routes\ArtistsController@promostats')->name('dashboard/promostats');


        Route::post('/{name}/dashboard/social', 'Routes\ArtistsController@social')->name('dashboard.social');
        Route::post('/{name}/dashboard/about', 'Routes\ArtistsController@about')->name('dashboard.about');
    });
});

//////////////////////////////////////////////
/////////// END OF VIEW ///////////////////////
//////////////////////////////////////////////











######################################################
################## Begin of Admin ####################
######################################################

Route::namespace('ADMIN')->domain('admin.' . env('APP_URL'))->group(function () {
    /////////////////Controllers///////////////////////////

    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::post('upload', 'Media\MediaManager@upload')->name('admin.upload');
        Route::post('uploadBulk', 'Media\MediaManager@bulkUpload')->name('admin.uploadBulk');
    });
    Route::post('login', 'Admin@login')->name('login.admin');




    /////////////// VIEW ////////////////////////////////
    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::get('/dashboard', function (Request $request) {
            return view('Admin.dashboard');
        })->name('Admin/dashboard');

        Route::group([''], function () {
            Route::get('/media', function () {
                return view('Admin.media');
            })->name('media/admin');
            Route::get('/media.{path}', function ($path) {
                $names = DB::table('elite_artist')->get();
                $genres = DB::table('genres')->get();
                switch ($path) {
                    case ('home'):
                        return view('Admin.include.media.home');
                        break;

                    case ('upload'):
                        return view('Admin.include.media.upload', [
                            'artists' => $names,
                            'genres' => $genres
                        ]);
                        break;

                    case ('al-upload'):
                        return view('Admin.include.media.al-upload',
                        [
                            'artists' => $names,
                            'genres' => $genres
                        ]);
                        break;

                    case ('manage'):
                        return view('Admin.include.media.manage');
                        break;

                    default:
                        return view('Admin.login');
                }
            });
        });
    });

    Route::get('/', function () {
        return view('Admin.login');
    })->name('login/admin');
});
######################################################
############ End of Admin ############################
######################################################


/////////// DEV //////////////////////////////
Route::get('/up', function () {
    $user = new User(
        [
            'name' => 'Efedua Believe',
            'email' => 'efed@gmail.com',
            'password' => bcrypt('beLL1923')
        ]
    );
    $user->save();
    $user->artists()->create([
        'name' => 'Mr Bell'
    ]);

    $user->roles()->attach(1);
});
Route::get('/make', function () {
    $user = User::find(1);
    $user->roles()->sync([2, 3, 4]);
    $user->admins()->create([
        'uuid' => (string) Str::uuid()
    ]);
});

