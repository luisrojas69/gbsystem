<?php

namespace App\Exports;

use App\Plank;
use Maatwebsite\Excel\Concerns\FromCollection;

class PlanksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Plank::all();
    }
}
