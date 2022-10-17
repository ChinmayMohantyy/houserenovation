<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\InventoryOrderRentableItem;

class BarcodesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return InventoryOrderRentableItem::where('inventory_id',)->get();
    }
}
