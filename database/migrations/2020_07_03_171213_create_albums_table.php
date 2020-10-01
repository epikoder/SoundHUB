<?php

use App\Http\Controllers\MediaQuery;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('artist');
            $table->char('admin', 50)->nullable();
            $table->mediumText('art')->default(MediaQuery::coverArt());
            $table->string('art_url')->nullable();
            $table->char('genre', 50);
            $table->char('duration')->nullable();
            $table->unsignedInteger('track_num');
            $table->string('type')->default('album');
            $table->unsignedBigInteger('owner_id');
            $table->string('owner_type');
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
        Schema::dropIfExists('albums');
    }
}
