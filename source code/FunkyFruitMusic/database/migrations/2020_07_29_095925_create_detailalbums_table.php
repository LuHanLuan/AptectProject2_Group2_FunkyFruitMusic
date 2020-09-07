<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailalbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailalbums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('detailsong_id')->unsigned();
            $table->foreign('detailsong_id')->references('id')->on('detailsongs')->onDelete('cascade');
            $table->integer('album_id')->unsigned();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            $table->unique(['detailsong_id', 'album_id']);
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
        Schema::dropIfExists('detailalbums');
    }
}
