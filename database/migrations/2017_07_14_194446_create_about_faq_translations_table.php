<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutFaqTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_faq_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('about_faq_id')->unsigned();
            $table->string('header');
            $table->string('description');
            $table->string('locale')->index();
            $table->unique(['about_faq_id','locale']);
            $table->foreign('about_faq_id')->references('id')->on('about_faqs')->onDelete('cascade');
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
        Schema::dropIfExists('about_faq_translations');
    }
}
