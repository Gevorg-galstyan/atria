<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('address');
            $table->string('status')->default(0);
            $table->integer('rol')->usignet()->default(0);
            $table->string('email')->unique();
            $table->string('href')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->boolean('block')->default(1);
            $table->boolean('new')->default(0);
            $table->string('driver_link')->nullable();
            $table->string('fb_google')->nullable();
            $table->string('driver_token')->nullable();
            $table->string('driver_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
