<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'name', 'details', 'inventory_type','available_quantity','unit_price',
    ];

}
