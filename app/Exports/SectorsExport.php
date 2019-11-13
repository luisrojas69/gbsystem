<?php

namespace App\Exports;

use App\Sector;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SectorsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    
		public function headings(): array
    {
        return [
            '#',
            'Codigo',
            'Descripcion',
        ];
    }
    /**
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sector::select('id', 'sector_co', 'sector_de')->orderBy('id', 'asc')->get();
    }
}
