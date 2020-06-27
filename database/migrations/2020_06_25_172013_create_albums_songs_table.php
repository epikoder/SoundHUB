<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums_songs', function (Blueprint $table) {
            $table->id('songs_id');
            $table->unsignedBigInteger('album_id');
            $table->timestamps();
            $table->foreign('songs_id')
            ->references('id')
            ->on('songs')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums_songs');
    }
}
