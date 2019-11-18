<?php

namespace App\Exports;

use App\Pluviometry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PluviometriesExport implements FromCollection, WithHeadings, ShouldAutoSize
{

	public function headings(): array
    {
        return [
            '#',
            'Sector',
            'Fecha',
            'mm'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pluviometry::select('id','sector_id', 'date_read', 'value_mm')->orderBy('sector_id', 'ASC')->orderBy('date_read', 'ASC')->get();
    }
}
