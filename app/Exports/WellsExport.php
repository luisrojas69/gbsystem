<?php

namespace App\Exports;

use App\Well;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class WellsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
   
   public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Tipo',
            'Status',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      return Well::select('id', 'well_na', 'type', 'status')->orderBy('id', 'asc')->get();
    }
}
