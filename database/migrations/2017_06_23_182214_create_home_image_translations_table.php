<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeImageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_image_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('home_image_id')->unsigned();
            $table->string('text_1');
            $table->string('text_2');
            $table->string('text_3');
            $table->string('locale')->index();
            $table->unique(['home_image_id','locale']);
            $table->foreign('home_image_id')->references('id')->on('home_images')->onDelete('cascade');
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
        Schema::dropIfExists('home_image_translations');
    }
}
