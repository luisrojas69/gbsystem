<?php

namespace App\Exports;
use App\Horometer;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HorometersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
	public function headings(): array
	{
		return [
			'#',
			'ID de Pozo',
			'Nombre del Pozo',
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
      return DB::table('horometers')

            ->join('wells', 'wells.id', '=', 'horometers.well_id')
            ->select('horometers.id',
            		'wells.id as id_pozo',
            		'wells.well_na as nombre_pozo',
        			'horometers.date_read',
        			'horometers.value',
        			'horometers.comment')
            	->get();
    }
}
