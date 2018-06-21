<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilterValueTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_value_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('filter_value_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['filter_value_id','locale']);
            $table->foreign('filter_value_id')->references('id')->on('filter_values')->onDelete('cascade');
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
        Schema::dropIfExists('filter_value_translations');
    }
}
