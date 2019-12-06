<?php

namespace App\Exports;

use App\Animal;
use Illuminate\Support\Facades\DB;
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
        $query = Animal::withCount('weighings')
        ->join('breeds', 'breeds.id', '=', 'animals.breed_id')
        ->get();
    }
}