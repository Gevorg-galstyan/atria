<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutTextTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_text_translations', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('about_text_id')->unsigned();
            $table->longText('header')->nullable();
            $table->longText('description')->nullable();
             $table->string('locale')->index();
            $table->unique(['about_text_id','locale']);
            $table->foreign('about_text_id')->references('id')->on('about_texts')->onDelete('cascade');



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
        Schema::dropIfExists('about_text_translations');
    }
}
