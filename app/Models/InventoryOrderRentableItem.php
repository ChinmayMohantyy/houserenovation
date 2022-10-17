<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryOrderRentableItem extends Model
{
    public function inventory_data_rent(){
        return $this->hasOne(Inventory::class,'id','inventory_id');
     }
}
