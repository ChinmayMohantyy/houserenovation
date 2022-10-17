<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryOrder extends Model
{
    public function inventory_item(){
        return $this->hasMany(InventoryOrderItem::class,'inventory_order_id','id');
     }

     public function warehouse_data(){
        return $this->hasOne(Warehouse::class,'id','warehouse_id');
     }

     public function inventory_rent(){
          return $this->hasMany(InventoryOrderRentableItem::class,'inventory_order_id','id');
     }

 
}
