<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilterSubTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_sub_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('filter_sub_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['filter_sub_id','locale']);
            $table->foreign('filter_sub_id')->references('id')->on('filter_subs')->onDelete('cascade');
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
        Schema::dropIfExists('filter_sub_translations');
    }
}
