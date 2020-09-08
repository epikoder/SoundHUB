<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('artist');
            $table->unsignedBigInteger('album_id')->nullable();
            $table->char('genre')->nullable();
            $table->char('duration');
            $table->string('url');
            $table->mediumText('art');
            $table->string('art_url')->nullable();
            $table->char('admin', 50)->nullable();
            $table->unsignedBigInteger('trackable_id')->nullable();
            $table->string('trackable_type')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracks');
    }
}
