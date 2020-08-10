<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Genres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        $file = fopen(storage_path('app').'../eyeD3-genres.txt', 'r');
        while (!feof($file)) {
            $line = fgets($file);
            $line = trim(str_replace(':', "", $line));
            $line = trim(preg_replace('!\d+!', '', $line));
            DB::table('genres')->insert([
                'name' => $line
            ]);
        }
        fclose($file);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
