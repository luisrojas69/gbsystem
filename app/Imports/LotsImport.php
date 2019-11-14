<?php

namespace App\Imports;

use App\Lot;
use Maatwebsite\Excel\Concerns\ToModel;

class LotsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Lot([
            'lot_co'    => $row[0],
            'lot_de'    => $row[1],
            'sector_id' => $row[2],
        ]);
    }
}
