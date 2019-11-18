<?php

namespace App\Imports;

use App\Pluviometry;
use Maatwebsite\Excel\Concerns\ToModel;

class PluviometriesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pluviometry([
            'date_read' => $row[0],
            'value_mm'  => $row[1],
            'sector_id' => $row[2],
            
        ]);
    }
}
