<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    
		public function headings(): array
    {
        return [
            '#',
            'Codigo',
            'Descripcion',
            'Rol'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('id', 'name', 'email')->orderBy('id', 'asc')->get();
    }
}
