<?php

use App\Http\Controllers\MediaQuery;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function GuzzleHttp\json_decode;

class CreateArtistsTable extends Migration
{
    use MediaQuery;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->mediumText('avatar')->default($this->artistArt());
            $table->json('social')->default(json_encode([
                'instagram' => null,
                'twitter' => null
            ]));
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
