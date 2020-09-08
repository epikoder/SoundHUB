<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DownloadCounter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_counter', function (Blueprint $table)  {
            $table->id('tracks_id');
            $table->unsignedBigInteger('downloads');
            $table->foreign('tracks_id')
            ->references('id')
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
        Schema::dropIfExists('download_counter');
    }
}
