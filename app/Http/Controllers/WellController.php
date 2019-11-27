<?php

namespace App\Http\Controllers;

use App\Well;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Shinobi
use Illuminate\Database\Eloquent\Model\Permission;
use Illuminate\Database\Eloquent\Model\Role;

//DomPDF
use Barryvdh\DomPDF\Facade as PDF;

//Laravel-Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WellsExport;


class WellController extends Controller
{

  public function __construct(){

    $this->middleware('can:sector.create')->only(['create', 'store']);

    $this->middleware('can:sector.index')->only(['index']);

    $this->middleware('can:sector.edit')->only(['edit', 'update']);

    $this->middleware('can:sector.show')->only(['show']);

    $this->middleware('can:sector.destroy')->only(['destroy']);

  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $wells= Well::name($request->name)->get();
      return view('pages.administration.farming.wells.wells.index', compact('wells'));
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
      $well = new Well;
      $well->well_na = $request->well_na;
      $well->type = $request->type;
      $well->status = $request->status;
      $well->comment = $request->comment;

      DB::beginTransaction();
      $well->save();
      DB::commit();
      session()->flash('my_message', 'Pozo Creado Correctamente');
      return redirect()->back();
    } catch (Exception $e) {
      session()->flash('my_error', $e->getMessage());
      DB::rollback();
    }
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Well  $well
     * @return \Illuminate\Http\Response
     */
    public function show(Well $well)
    {
      return view('pages.administration.farming.wells.wells.show', compact('well'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Well  $well
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
     try{
      $well = Well::findOrFail($request->well_id);
      $well->well_na = $request->get('well_na');
      $well->status = $request->get('status');
      $well->type = $request->get('type');
      $well->comment = $request->get('comment');
      DB::beginTransaction();
      $well->save();
      DB::commit();
      session()->flash('my_message', 'Pozo Modificado Correctamente');
      return redirect()->back();
    }catch(Exception $e){
      session()->flash('my_error', $e->getMessage());
      DB::rollback();
    }
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Well  $well
     * @return \Illuminate\Http\Response
     */
    public function destroy(Well $well)
    {
      try{
        $well =Well::find($well->id);
        DB::beginTransaction();
        $well->delete();
        DB::commit();
        session()->flash('my_message', 'Pozo Eliminado Correctamente');
        return redirect()->back();
      }catch(Exception $e){
        session()->flash('my_error', $e->getMessage());
        DB::rollback();
      }
    }

      //Ejecucion del Metodo que genera el Excel
    public function wellsExcel(){       
      return Excel::download(new WellsExport, 'pozos-list-'.date('Y-m-d_H:i:s').'.xlsx');
    }


    //Funcion para Generar Reporte de Animales Activos en PDF
     public function wellsPDF(Request $request){
        $wells = Well::name($request->name)->get();
        $date = date('d-m-Y');
        $pdf = PDF::loadView('pages.administration.reports.wells-pdf', compact('wells', 'date'));
        return $pdf->download('pozos-list-'.date('Y-m-d_H:i:s').'.pdf');
    }

  }
