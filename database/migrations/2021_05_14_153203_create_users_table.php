<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->timestamps();
            $table->integer('userID')->nullable();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('address')->nullable();
            $table->date('userBirthday')->nullable();
            $table->string('phone')->nullable();
            $table->integer('gender')->nullable();
            $table->string('image')->nullable();
            $table->integer('userTypeID')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
