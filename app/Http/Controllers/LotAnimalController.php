<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\LotAnimal;

//DomPDF
use Barryvdh\DomPDF\Facade as PDF;

//Laravel-Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LotsAnimalsExport;

use Illuminate\Http\Request;

class LotAnimalController extends Controller
{
    public function __construct(){

        $this->middleware('can:lotsAnimals.create')->only(['create', 'store']);

        $this->middleware('can:lotsAnimals.index')->only(['index']);

        $this->middleware('can:lotsAnimals.edit')->only(['edit', 'update']);

        $this->middleware('can:lotsAnimals.show')->only(['show']);

        $this->middleware('can:lotsAnimals.destroy')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lotsAnimals= LotAnimal::name($request->name)->get();
        return view('pages.administration.ganaderia.lots.index', compact('lotsAnimals'));
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
        $lotAnimal = new LotAnimal;
        $lotAnimal->lot_co = $request->lot_co;
        $lotAnimal->lot_de = $request->lot_de;
        $lotAnimal->date_in = $request->date_in;
        $lotAnimal->comment = $request->comment;

        DB::beginTransaction();
        $lotAnimal->save();
        DB::commit();
        session()->flash('my_message', 'Lote de Animales Creado Correctamente');
        return redirect()->back();
    } catch (Exception $e) {
        session()->flash('my_error', $e->getMessage());
        DB::rollback();
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ("esta es la descripcion del Lote Animal " .$id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());
        try{
          $lotAnimal = LotAnimal::findOrFail($request->lot_id);
          $lotAnimal->lot_co = $request->get('lot_co');
          $lotAnimal->lot_de = $request->get('lot_de');
          $lotAnimal->date_in = $request->get('date_in');
          $lotAnimal->comment = $request->get('comment');
          DB::beginTransaction();
          $lotAnimal->save();
          DB::commit();
          session()->flash('my_message', 'Lote Animal Modificado Correctamente');
          return redirect()->back();
      }catch(Exception $e){
          session()->flash('my_error', $e->getMessage());
          DB::rollback();
      }
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try{
        $lotAnimal =Sector::find($lotAnimal->id);
        DB::beginTransaction();
        $lotAnimal->delete();
        DB::commit();
        session()->flash('my_message', 'Lote de Animales Eliminado Correctamente');
        return redirect()->back();
    }catch(Exception $e){
      session()->flash('my_error', $e->getMessage());
      DB::rollback();
  }
}


//Ejecucion del Metodo que genera el Excel
public function lotsAnimalsExcel(){       
    return Excel::download(new LotsAnimalsExport, 'lots-animals-list-'.date('Y-m-d_H:i:s').'.xlsx');
}


//Llamado a la Vista con el Invoice del PDF
public function lotsAnimalsPDF(){
    $lotsAnimals = LotAnimal::All();
    $date = date('d-m-Y');
    $pdf = PDF::loadView('pages.administration.reports.lotsAnimals-pdf', compact('lotsAnimals', 'date'));
    return $pdf->stream('lots-animals-list-'.date('Y-m-d_H:i:s').'.pdf');
}





}
