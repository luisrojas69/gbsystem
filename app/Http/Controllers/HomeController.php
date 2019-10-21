<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Sector;
use App\lot;
use App\Plank;

class HomeController extends Controller
{	

	public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
    	$sectors= Sector::all();
      $lots= Lot::all();
      $planks= Plank::all();
   	        $result= DB::table('captures')
            ->join('crops', 'crops.id', '=', 'captures.crop_id')
            ->select('crops.crop_na as cultivo',
                        DB::raw(
                              'IFNULL(SUM(CASE WHEN activity_id = 1 THEN area ELSE 0 END ), 0) anterior,
                               IFNULL( SUM(CASE WHEN activity_id = 1 THEN area ELSE 0 END), 0) total_sembrado,
                               IFNULL( SUM(CASE WHEN activity_id = 2 THEN area ELSE 0 END), 0) total_cosechado,
                               IFNULL( SUM(CASE WHEN activity_id = 3 THEN area ELSE 0 END), 0) total_ajustado,
                               IFNULL(SUM(CASE WHEN activity_id = 1 THEN area ELSE 0 END ) - (SUM(CASE WHEN activity_id = 2 THEN area ELSE 0 END ) + SUM(CASE WHEN activity_id = 3 THEN area ELSE 0 END )), 0) disponible_para_corte,
                               IFNULL(SUM(CASE WHEN activity_id = 1 THEN area ELSE 0 END ), 0) disponible_para_siembra
                                '))
            ->groupBy('cultivo') 
            ->get();

            return view('pages.home', compact('sectors','lots','planks','result'));

    }


}
