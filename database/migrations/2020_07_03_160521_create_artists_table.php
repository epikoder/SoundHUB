<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function GuzzleHttp\json_decode;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $social = json_encode([
                'instagram' => '',
                'twitter' => ''
            ]);
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->char('sex')->nullable();
            $table->string('avatar_url')->nullable();
            $table->string('bio')->nullable();
            $table->json('social')->default($social);
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('artists');
    }
}
