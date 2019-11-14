<?php

namespace App\Imports;

use App\Plank;
use Maatwebsite\Excel\Concerns\ToModel;

class PlanksImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Plank([
            //
        ]);
    }
}
