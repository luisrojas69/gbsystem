<?php

namespace App\Exports;
use App\LotAnimal;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\FromCollection;

class LotsAnimalsExport implements FromCollection, WithHeadings, ShouldAutoSize
{	

		public function headings(): array
    {
        return [
            '#',
            'Fecha de Entrada',
            'Codigo',
            'Descripcion',
            'Observaciones',
            'Num. Animales'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return LotAnimal::select('id', 'date_in', 'lot_co', 'lot_de')->orderBy('id', 'asc')->get();

        $query = LotAnimal::withCount('animals')->get()->map->only('id', 'date_in', 'lot_co', 'lot_de', 'comment','animals_count');
        //dd($query);
        return $query;
    }
}
