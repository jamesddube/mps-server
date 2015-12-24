<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActivationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('user_activation', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned()->unique();
          $table->integer('activation_code')->unique();
          $table->boolean('activated');
          $table->foreign('user_id')
              ->references('id')->on('user_id')
              ->onUpdate('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_activation');
    }
}
