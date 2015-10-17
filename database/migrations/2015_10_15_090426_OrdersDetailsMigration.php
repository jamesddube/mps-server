<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersDetailsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            //$table->dropForeign('order_details_order_id_foreign');
            $table->string('order_details_id');
            $table->string('order_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->timestamps();
            $table->primary('order_details_id');
            $table->foreign('order_id')
                ->references('order_id')->on('orders')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_details');
    }
}
