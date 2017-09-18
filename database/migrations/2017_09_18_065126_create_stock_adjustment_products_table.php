<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStockAdjustmentProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_adjustment_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock_adjustment_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('stock_adjustment_id')->references('id')->on('stock_adjustments');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stock_adjustment_products');
    }
}
