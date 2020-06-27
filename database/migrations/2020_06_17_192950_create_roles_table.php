<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id');
            $table->string('name')->unique();
        });

        $user = App\Models\Auth\Roles::create([
            'name' => 'user'
        ]);
        $user->save();

        $artist = App\Models\Auth\Roles::create([
            'name' => 'artist'
        ]);
        $artist->save();

        $admin = App\Models\Auth\Roles::create([
            'name' => 'admin'
        ]);
        $admin->save();

        $root = App\Models\Auth\Roles::create([
            'name' => 'root'
        ]);
        $root->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
