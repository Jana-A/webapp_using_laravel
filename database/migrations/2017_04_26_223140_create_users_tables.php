<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('users_table_id');
            $table->string('username');
            $table->text('password');
            $table->text('firstname')->nullable();
            $table->text('lastname')->nullable();
            $table->text('email');
            $table->text('organisation')->nullable();
            $table->text('occupation')->nullable();
            $table->text('city')->nullable();
            $table->text('country')->nullable();
            $table->binary('image')->nullable();
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
