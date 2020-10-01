<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlaylistsTracks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists_tracks', function (Blueprint $table) {
            $table->unsignedBigInteger('playlist_id');
            $table->string('track_slug');
            $table->foreign('playlist_id')
            ->references('id')
            ->on('playlists')
            ->onDelete('cascade');
            $table->foreign('track_slug')
            ->references('slug')
            ->on('tracks')
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
        Schema::dropIfExists('playlists_tracks');
    }
}
