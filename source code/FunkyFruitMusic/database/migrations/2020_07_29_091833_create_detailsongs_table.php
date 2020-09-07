<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailsongs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('song_id')->unsigned();
            $table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');
            $table->integer('singer_id')->unsigned();
            $table->foreign('singer_id')->references('id')->on('singers')->onDelete('cascade');
            $table->unique(['song_id', 'singer_id']);
            $table->string('file');
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
        Schema::dropIfExists('detailsongs');
    }
}
