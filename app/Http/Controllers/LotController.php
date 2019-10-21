<?php

namespace App\Http\Controllers;
use App\Lot;
use App\Sector;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LotController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('isadmin');
    }


	public function index()
    {
        $lots=Lot::all();
    	return view('pages.administration.lots.index', compact('lots'));
    }


    public function create(Sector $sector){
        $sectors = Sector::orderBy('sector_co', 'ASC')->get();
    	return view('pages.administration.lots.create', compact('sectors'));
    }

    
    public function show (Lot $lot)
    {
        return view('pages.administration.lots.show', compact('lot'));
    }


    public function store(Request $request){

        try {
            $lot = new Lot;
            $lot->lot_co = $request->lot_co;
            $lot->lot_de = $request->lot_de;
            $lot->sector_id= $request->sector_id;

            DB::beginTransaction();
            $lot->save();
            DB::commit();
            session()->flash('my_message', 'Lote Creado Correctamente');
            return redirect('establishments/lot/create');
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }

    }


    public function destroy(Lot $lot)
    {
        try {
        $lot=Lot::find($lot->id);
        DB::beginTransaction();
        $lot->delete();
        DB::commit();
        session()->flash('my_message', 'Tablon Eliminado Correctamente');
        return redirect('establishments/lot');
        } catch (Exception $e) {
        session()->flash('my_error', $e->getMessage());    
        DB::rollback();
        }
    }


    public function edit(Lot $lot)
    {
        $sector=Sector::all();
        return view('pages.administration.lots.edit', compact('lot','sector'));
    }

    public function update(Request $request, Lot $lot)
    {
        try {
            $lot = Lot::find($lot->id);
            $lot->lot_co = $request->get('lot_co');
            $lot->lot_de = $request->get('lot_de');
            DB::beginTransaction();
            $lot->save();
            DB::commit();
            session()->flash('my_message', 'Lote Modificado Correctamente');
            return redirect('establishments/lot');
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }
    }


}
