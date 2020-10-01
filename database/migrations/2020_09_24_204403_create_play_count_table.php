<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_count', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->unsignedBigInteger('count')->default(0);
            $table->timestamps();
            $table->foreign('slug')
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
        Schema::dropIfExists('play_count');
    }
}
