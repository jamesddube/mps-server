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
            $table->string('order_details_id');
            $table->string('order_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->string('sales_rep');
            $table->string('status');
            $table->string('sync_status');
            $table->timestamps();
            $table->primary('order_details_id');
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
