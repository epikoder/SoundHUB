<?php

namespace App\Providers;

use App\Http\Controllers\MediaQuery;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! \App\User::where('email', Config::get('constants.admin.email'))->first()) {
            $user = new \App\User(
                [
                    'name' => Config::get('constants.admin.name', 'admin'),
                    'email' => Config::get('constants.admin.email', 'efedua.bell@gmail.com'),
                    'password' => bcrypt(Config::get('constants.admin.password', 'password'))
                ]
            );
            $user->save();
            $user->admins()->create([
                'uuid' => (string) Str::uuid()
            ]);
            $user->roles()->attach([3, 4]);
        }
    }
}
