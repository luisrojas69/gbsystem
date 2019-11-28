<?php

namespace App\Exports;
use App\Horometer;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HorometersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
	public function headings(): array
	{
		return [
			'#',
			'Fecha Lectura',
			'Valor Leido',
			'Observaciones'
		];
	}

    /**
    * @return \Illuminate\Support\Collection
    */
   public function collection()
    {
    return Horometer::select('id', 'date_read', 'value', 'comment')->orderBy('id', 'asc')->get();
    }
}
