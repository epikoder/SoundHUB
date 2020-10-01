<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Admin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id('user_id');
            $table->uuid('uuid')->unique();
            $table->timestamps();
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });

        if (!\App\User::where('email', Config::get('constants.admin.email'))->first()) {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
