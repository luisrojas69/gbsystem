<?php

namespace App\Exports;

use App\Capture;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class CapturesExport implements FromView, ShouldAutoSize
{

	public function view(): View
	{
		return view('exports.captures', [
			'captures' => DB::table('captures')
        ->join('planks', 'planks.id', '=', 'captures.plank_id')
        ->join('activities', 'activities.id', '=', 'captures.activity_id')
        ->join('crops', 'crops.id', '=', 'captures.crop_id')
        ->select('captures.id','captures.activity_date as fecha', 'captures.created_at', 'captures.area', 'planks.plank_de', 'planks.plank_co', 'crops.crop_na', 'activities.activity_na')
        ->orderBy('fecha', 'desc')
        ->get()
		]);
	}

}
