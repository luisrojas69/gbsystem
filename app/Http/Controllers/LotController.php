<?php

namespace App\Http\Controllers;
use App\Lot;
use App\Sector;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Laravel-Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LotsExport;
use App\Imports\LotsImport;


class LotController extends Controller
{
    public function __construct(){

        $this->middleware('can:lot.create')->only(['create', 'store']);

        $this->middleware('can:lot.index')->only(['index']);

        $this->middleware('can:lot.edit')->only(['edit', 'update']);

        $this->middleware('can:lot.show')->only(['show']);

        $this->middleware('can:lot.destroy')->only(['destroy']);

    }

	public function index(Request $request)
    {
        $lots=Lot::name($request->name)->get();
        $sectors = Sector::select('id','sector_de', 'sector_co')->orderBy('sector_co', 'ASC')->get();
    	return view('pages.administration.farming.stablishments.lots.index', compact('lots', 'sectors'));
    }


    public function create(Sector $sector){
        $sectors = Sector::select('id','sector_de')->orderBy('sector_co', 'ASC')->get();
    	return view('pages.administration.farming.stablishments.lots.create', compact('sectors'));
    }

    
    public function show (Lot $lot)
    {
        return view('pages.administration.farming.stablishments.lots.show', compact('lot'));
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
            return redirect()->back();
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
        return view('pages.administration.farming.stablishments.lots.edit', compact('lot','sector'));
    }

    public function update(Request $request)
    {
        try {
            $lot = Lot::findOrFail($request->lot_id);
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


    public function import(){
        return view('pages.administration.farming.stablishments.lots.import');
    }


    public function importExcel(Request $request){
       $file = $request->file('file');

       Excel::import(new LotsImport, $file);

       session()->flash('my_message', 'Lotes importados Correctamente');
       return redirect()->back();
    }


      //Ejecucion del Metodo que genera el Excel
    public function lotsExcel(){       
        return Excel::download(new LotsExport, 'lotes-list-'.date('Y-m-d_H:i:s').'.xlsx');
    }



}
