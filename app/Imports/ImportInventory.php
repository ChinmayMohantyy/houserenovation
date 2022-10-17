<?php

namespace App\Imports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportInventory implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Inventory([
            'name' => $row['name'],
            'details' => $row['details'],
            'inventory_type' => $row['inventory_type'],
            'available_quantity' => $row['available_quantity'],
            'unit_price' => $row['unit_price'],
            'status' => '1',
           
        ]);
    }
}
