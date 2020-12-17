<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipTosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_tos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ship_order_id');
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('country');

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
        Schema::dropIfExists('ship_tos');
    }
}
