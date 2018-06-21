<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->usignet();
            $table->integer('user_id')->usignet();
            $table->string('row_id');
            $table->string('color');
            $table->string('product_name');
            $table->string('image_name');
            $table->integer('qty')->usignet();
            $table->string('price');
            $table->boolean('fulfilled')->default(0);
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
        Schema::dropIfExists('cart_tables');
    }
}
