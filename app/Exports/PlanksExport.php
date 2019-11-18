<?php

namespace App\Exports;

use App\Plank;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class PlanksExport implements FromCollection, WithHeadings, ShouldAutoSize
{
		public function headings(): array
    {
        return [
            '#',
            'Codigo',
            'Descripcion',
            'Hectareas',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Plank::select('id', 'plank_co', 'plank_de', 'plank_area')->orderBy('id', 'asc')->get();
    }
}
