<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutSldTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_sld_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('about_sld_id')->unsigned();
            $table->string('text')->nullable();
            $table->string('locale')->index();
            $table->unique(['about_sld_id','locale']);
            $table->foreign('about_sld_id')->references('id')->on('about_slds')->onDelete('cascade');
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
        Schema::dropIfExists('about_sld_translations');
    }
}
