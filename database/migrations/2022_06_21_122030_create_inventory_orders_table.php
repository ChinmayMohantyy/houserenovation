<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('house_repair_request_id');
            $table->bigInteger('house_captain_id');
            $table->bigInteger('warehouse_id')->nullable();
            $table->double('grand_total_price',10,2)->default(0.00);
            $table->bigInteger('admin_approved')->default(0);
            $table->bigInteger('admin_id')->nullable();
            $table->tinyInteger('item_collected')->nullable();
            $table->timestamp('item_collected_at')->nullable();
            $table->bigInteger('warehouse_manager_id')->nullable();
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
        Schema::dropIfExists('inventory_orders');
    }
}