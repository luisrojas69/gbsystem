<?php

namespace App\Exports;

use App\Lot;
use Maatwebsite\Excel\Concerns\FromCollection;

class LotsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lot::all();
    }
}
