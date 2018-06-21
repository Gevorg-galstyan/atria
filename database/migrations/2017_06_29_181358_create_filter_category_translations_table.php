<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilterCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('filter_category_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->integer('cat_id')->usignet();
            $table->unique(['filter_category_id','locale']);
            $table->foreign('filter_category_id')->references('id')->on('filter_categories')->onDelete('cascade');
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
        Schema::dropIfExists('filter_category_translations');
    }
}
