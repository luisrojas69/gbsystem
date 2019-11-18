<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Plank;
use App\Lot;
use App\Sector;

class PlankController extends Controller
{
    public function __construct(){

        $this->middleware('can:plank.create')->only(['create', 'store']);

        $this->middleware('can:plank.index')->only(['index']);

        $this->middleware('can:plank.edit')->only(['edit', 'update']);

        $this->middleware('can:plank.show')->only(['show']);

        $this->middleware('can:plank.destroy')->only(['destroy']);

    }

	public function index()
    {
        $sectors = Sector::with('lots')->get(['id','sector_de']);
        $lots = Lot::with('Sector')->get(['id','lot_de','sector_id']);
        $planks = Plank::with('Lot')->get(['id','plank_de', 'plank_area','plank_co','lot_id']);

        return view('pages.administration.farming.stablishments.planks.index', compact('lots','planks', 'sectors'));
    }


    public function plank_data()
    {
        $planks=Plank::all();
        return view('pages.administration.farming.stablishments.planks.index', compact('planks'));
    }


    public function create(){
        $sectors = Sector::with('lots')->get(['id','sector_de']);
        $lots = Lot::with('Sector')->get(['id','lot_de','sector_id']);
    	return view('pages.administration.farming.stablishments.planks.create', compact('sectors', 'lots'));
        //dd($lots);
    }

    
    public function show (Plank $plank)
    {
        $result= DB::table('captures')

            ->join('planks', 'planks.id', '=', 'captures.plank_id')
            ->join('crops', 'crops.id', '=', 'captures.crop_id')
            ->join('varieties', 'varieties.id', '=', 'captures.variety_id')    
            ->select('planks.plank_de as nombre_tablon',
                     'planks.plank_co as codigo_tablon',
                     'planks.plank_area as capacidad_tablon',
                     'crops.crop_na as cultivo','crops.id as id_cultivo',
                     'varieties.variety_na as variedad','varieties.id as id_variedad',
                        DB::raw(
                              'IFNULL( SUM(CASE WHEN activity_id = 1 THEN area ELSE 0 END), 0) total_sembrado,
                               IFNULL( SUM(CASE WHEN activity_id = 2 THEN area ELSE 0 END), 0) total_cosechado,
                               IFNULL( SUM(CASE WHEN activity_id = 3 THEN area ELSE 0 END), 0) total_ajustado,
                               IFNULL(SUM(CASE WHEN activity_id = 1 THEN area ELSE 0 END ) - (SUM(CASE WHEN activity_id = 2 THEN area ELSE 0 END ) + SUM(CASE WHEN activity_id = 3 THEN area ELSE 0 END )), 0) sembrado_actual,
                               planks.plank_area - IFNULL( SUM(CASE WHEN activity_id = 1 THEN area WHEN activity_id = 2 THEN (-1)* area WHEN activity_id = 3 THEN (-1)* area ELSE 0  END), 0) disponible
                              '))
            ->where('plank_id', $plank->id)
            ->get();

        return view('pages.administration.farming.captures.show', compact('result'));         
        //dd($result);
    }

    public function store(Request $request){

        try {
            $plank = new Plank;
            $plank->plank_co = $request->plank_co;
            $plank->plank_de = $request->plank_de;
            $plank->plank_area = $request->plank_area;
            $plank->lot_id= $request->lot_id;

            DB::beginTransaction();
            $plank->save();
            DB::commit();
            session()->flash('my_message', 'Tablon Creado Correctamente');
            return redirect('establishments/plank/create');
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }

    }


    public function destroy(Plank $plank)
    {
        try {
        $plank=Plank::find($plank->id);
        DB::beginTransaction();
        $plank->delete();
        DB::commit();
        session()->flash('my_message', 'Tablon Eliminado Correctamente');
        return redirect('establishments/plank');
        } catch (Exception $e) {
        session()->flash('my_error', $e->getMessage());    
        DB::rollback();
        }
    }


    public function edit(Plank $plank)
    {
        $lot=Lot::all();
        return view('pages.administration.farming.stablishments.planks.edit', compact('plank','lot'));
    }

    public function update(Request $request)
    {
        try {
            $plank = Plank::findOrFail($request->plank_id);
            $plank->plank_co = $request->get('plank_co');
            $plank->plank_de = $request->get('plank_de');
			$plank->plank_area = $request->get('plank_area');
            DB::beginTransaction();
            $plank->save();
            DB::commit();
            session()->flash('my_message', 'Tablon Modificado Correctamente');
            return redirect('establishments/plank');
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }
    }

    public function import(){
        return ('En Proceso');
    }
}
