<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryOrderItem extends Model
{
    public function inventory(){
        return $this->hasOne(Inventory::class,'id','inventory_id');
     }
}
