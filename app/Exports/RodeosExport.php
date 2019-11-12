<?php

namespace App\Exports;

use App\Rodeo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RodeosExport implements FromCollection, WithHeadings, ShouldAutoSize
{	

	public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Descripcion',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Rodeo::select('id', 'rodeo_na', 'rodeo_de')->orderBy('id', 'asc')->get();
    }


}
