<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ship_order_id');
            $table->string('title');
            $table->string('note');
            $table->unsignedInteger('quantity');
            $table->double('price', 10, 2);

            $table->foreign('ship_order_id')->references('id')->on('ship_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ship_items');
    }
}
