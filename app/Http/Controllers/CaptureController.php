<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Plank;
use App\Lot;
use App\Sector;
use App\Variety;
use App\Crop;
use App\Capture;
use App\Activity;


//Laravel-Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CapturesExport;

class CaptureController extends Controller
{
    public function __construct(){

        $this->middleware('can:capture.create')->only(['create', 'store']);

        $this->middleware('can:capture.index')->only(['index']);

        $this->middleware('can:capture.edit')->only(['edit', 'update']);

        $this->middleware('can:capture.show')->only(['show']);

        $this->middleware('can:capture.destroy')->only(['destroy']);

    }

    public function index()
    {
        $captures= DB::table('captures')
        ->join('planks', 'planks.id', '=', 'captures.plank_id')
        ->join('activities', 'activities.id', '=', 'captures.activity_id')
        ->join('crops', 'crops.id', '=', 'captures.crop_id')
        ->select('captures.id','captures.activity_date as fecha', 'captures.area', 'planks.plank_de', 'crops.crop_na', 'activities.activity_na')
        ->orderBy('id', 'desc')
        ->get();
        //$captures= Capture::all();
        return view('pages.administration.farming.captures.index', compact('captures'));
        //dd($captures);
    }


    public function create ()
    {	

        $sectors = Sector::with('lots')->get(['id','sector_de']);
        $lots = Lot::with('Sector')->get(['id','lot_de','sector_id']);
        $planks = Plank::with('Lot')->get(['id','plank_de','lot_id']);
        $crops = Crop::get(['id','crop_de']);
        $varieties = Variety::get(['id', 'variety_na', 'crop_id']);
        return view('pages.administration.farming.captures.create', compact('lots','planks', 'varieties', 'crops', 'sectors'));
    }

    public function show (Capture $capture){
       return ('k');
   }

   public function store(Request $request)
   {
        //dd($request->all());
    try {
       $capture =new Capture;
       $capture->plank_id = $request->plank_id;
       $capture->activity_id = $request->activity_id;
       $capture->crop_id = $request->crop_id;
       $capture->variety_id = $request->variety_id;
       $capture->area = (double)$request->get('area');
       $capture->comment = $request->comment;
       $capture->activity_date = $request->activity_date;
       DB::beginTransaction();
       $capture->save();
       DB::commit();
       session()->flash('my_message', 'Capture Registrado Correctamente'); 
       return redirect()->back(); 	
   } catch (Exception $e) {
       session()->flash('my_error', $e->getMessage());
       DB::rollback();
   }

}

public function destroy(Capture $capture){

   try{
      $capture =Capture::find($capture->id);
      DB::beginTransaction();
      $capture->delete();
      DB::commit();
      session()->flash('my_message', 'capture Eliminado Correctamente');
      return redirect()->back();
  }catch(Exception $e){
      session()->flash('my_error', $e->getMessage());
      DB::rollback();
  }
}

public function edit(Capture $capture, Plank $plank){
   $activities = Activity::all();
   $crops = Crop::all();
   $varieties = Variety::all();
   return view('pages.administration.farming.captures.edit', compact('capture', 'activities', 'crops', 'plank', 'varieties'));
}


public function update(Request $request, Capture $capture){
   try{
      $capture = Capture::find($capture->id);
      $capture->capture_co = $request->get('capture_co');
      $capture->capture_de = $request->get('capture_de');
      DB::beginTransaction();
      $capture->save();
      DB::commit();
      session()->flash('my_message', 'capture Modificado Correctamente');
      return redirect('capture');
  }catch(Exception $e){
      session()->flash('my_error', $e->getMessage());
      DB::rollback();
  }
}

//Funcion para Generar Reporte de Animales Activos en Excel
public function capturesExcel(){
   return Excel::download(new CapturesExport, 'capture-list-'.date('Y-m-d_H:i:s').'.xlsx');
}



}
