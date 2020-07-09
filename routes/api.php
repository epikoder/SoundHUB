<?php

use App\User;
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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['middleware' => 'cors'], function () {
    Route::group(['middleware' => 'regs'], function () {
        Route::get('versignup', 'API\Auth\AuthController@verSignup')->name('versignup');
        Route::post('signup', 'API\Auth\AuthController@signup')->name('signup');
    });
    Route::get('regsignup', 'API\Auth\AuthController@regSignup')->name('regsignup');
    Route::post('login', 'API\Auth\AuthController@login');

    Route::group(['prefix' => 'pay'], function () {
        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('paystack/pay', 'API\Payment\PaymentController@redirectToGateway')->name('paystack.pay');
        });
        Route::get('paystack/callback', 'API\Payment\PaymentController@handleGatewayCallback')->name('paystack.callback');
    });
});
Route::group(['prefix' => 'media'], function () {
    Route::post('upload', 'API\Media\MediaManager@upload')->name('media.upload')->middleware('auth:api');
});

// TEST

Route::get('cre', function () {
    $user = User::find(1);
    if ($user) {
        return response()->json([], 409);
    }
    $user = new User([
        'name' => 'Efedua',
        'email' => 'efedua.bell@gmail.com',
        'password' => bcrypt('password')
    ]);
    $user->save();
});
Route::get('art', function () {
    $user = User::find(1);
    $user->artists()->create([
        'name' => 'Belly'
    ]);
    return response()->json();
});
// Safe strap
Route::get('redirectToLogin', function () {
    return redirect('http://localhost:8080/login', 302, [], true);
})->name('login');
