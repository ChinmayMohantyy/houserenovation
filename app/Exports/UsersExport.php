<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\WithHeadingRow;



class UsersExport implements FromCollection,WithHeadingRow
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inventory::all();
    }
}
