<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('inventory_order_id');
            $table->bigInteger('inventory_id');
            $table->bigInteger('required_quantity');
            $table->double('unit_price',10,2);
            $table->double('total_price',10,2);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('inventory_order_items');
    }
}
