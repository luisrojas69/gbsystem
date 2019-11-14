<?php

namespace App\Imports;

use App\Sector;
use Maatwebsite\Excel\Concerns\ToModel;

class SectorsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Sector([
            'sector_co' => $row[0],
            'sector_de' => $row[1],
        ]);
    }
}
