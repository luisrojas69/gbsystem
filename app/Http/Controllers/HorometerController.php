<?php

namespace App\Http\Controllers;

use App\Horometer;
use App\Well;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Laravel-Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HorometersExport;

class HorometerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $wells = Well::with(['horometers' => function ($query) {
           $query->latest()->take(2);
        }])->get();

        $horometers = Horometer::all();
        //$wells = Well::where('status', '!=', 'parado')->get();
        return view("pages.administration.farming.wells.horometers.index", compact('horometers', 'wells'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     try {
        $horometer = new Horometer;
        $horometer->well_id = $request->well_id;
        $horometer->date_read = $request->date_read;
        $horometer->value = $request->value;
        $horometer->comment = $request->comment;

        DB::beginTransaction();
        $horometer->save();
        DB::commit();
        session()->flash('my_message', 'Lectura de Horometro Ingresada Correctamente al Pozo '.$request->name_pozo);
        return redirect()->back();
    } catch (Exception $e) {
      session()->flash('my_error', $e->getMessage());
      DB::rollback();
  }
}



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Horometer  $horometer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horometer $horometer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Horometer  $horometer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horometer $horometer)
    {
        //
    }


    public function HorometersByWells($id){
        $well = Well::findOrFail($id);
        $query=Horometer::where("well_id", $well->id )->orderBy('id', 'DESC')->first();
        if($query != null){
            $lastHorometer=$query->value;
        }else{
            $lastHorometer=0;
        }
        return response()->json($lastHorometer);
    }


    //Ejecucion del Metodo que genera el Excel
    public function horometersExcel(){       
        return Excel::download(new HorometersExport, 'horometros-list-'.date('Y-m-d_H:i:s').'.xlsx');
    }
}
