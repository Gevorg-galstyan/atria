<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_filters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filter_value');
            $table->integer('price')->nullable();
            $table->string('plusMinus')->nullable();
            $table->integer('filter_id');
            $table->integer('prod_id');
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
        Schema::dropIfExists('pro_filters');
    }
}
