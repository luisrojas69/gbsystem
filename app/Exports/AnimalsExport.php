<?php

namespace App\Exports;

use App\Animal;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class AnimalsExport implements FromView, WithHeadings, ShouldAutoSize
{

    public function view(): View
    {
        return view('exports.animals', [
            'animals' => Animal::get()
        ]);
    }


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
        return Animal::select('id', 'animal_na', 'animal_col')->orderBy('id', 'asc')->get();
    }
}