<?php

namespace App\Exports;

use App\Animal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AnimalsExport implements FromCollection, WithHeadings, ShouldAutoSize
{

	public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Color',
        ];
    }
    /**
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Animal::select('id', 'animal_na', 'animal_col')
				        ->where('rodeo_id', 1)
				        ->orderBy('id', 'asc')
				        ->get();
    }
}