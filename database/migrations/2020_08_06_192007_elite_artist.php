<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliteArtist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elite_artist', function(Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->mediumText('avatar');
            $table->json('social')->default(json_encode([
                'instagram' => null,
                'twitter' => null
            ]));
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elite_artist');
    }
}
