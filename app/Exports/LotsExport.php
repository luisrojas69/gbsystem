<?php

namespace App\Exports;

use App\Lot;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LotsExport implements FromCollection, WithHeadings, ShouldAutoSize
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
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lot::select('id', 'lot_co', 'lot_de')->orderBy('id', 'asc')->get();
    }
}
