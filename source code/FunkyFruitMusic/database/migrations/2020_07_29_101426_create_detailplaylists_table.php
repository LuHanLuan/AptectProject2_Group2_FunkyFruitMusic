<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailplaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailplaylists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('detailsong_id')->unsigned();
            $table->foreign('detailsong_id')->references('id')->on('detailsongs')->onDelete('cascade');
            $table->integer('playlist_id')->unsigned();
            $table->foreign('playlist_id')->references('id')->on('playlists')->onDelete('cascade');
            $table->unique(['detailsong_id', 'playlist_id']);
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
        Schema::dropIfExists('detailplaylists');
    }
}
