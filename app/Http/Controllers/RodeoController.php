<?php

namespace App\Http\Controllers;

use App\Rodeo;
use App\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\Model\Permission;
use Illuminate\Database\Eloquent\Model\Role;
use App\Http\Requests\RodeoRequest;

class RodeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

        
        $this->middleware('can:rodeo.create')->only(['create', 'store']);

        $this->middleware('can:rodeo.index')->only(['index']);

        $this->middleware('can:rodeo.edit')->only(['edit', 'update']);

        $this->middleware('can:rodeo.show')->only(['show']);

        $this->middleware('can:rodeo.destroy')->only(['destroy']);

    }

    public function index()
    {
        $rodeos = Rodeo::all();
        return view('pages.administration.ganaderia.rodeos.index', compact('rodeos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.administration.ganaderia.rodeos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RodeoRequest $request)
    {
        try {
            $rodeo = new Rodeo;
            $rodeo->rodeo_na = $request->rodeo_na;
            $rodeo->rodeo_de = $request->rodeo_de;
            DB::beginTransaction();
            $rodeo->save();
            DB::commit();
            session()->flash('my_message','Rodeo Registrado Correctamente');
            return back()->withInput($request->flash()); 
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();           
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rodeo  $rodeo
     * @return \Illuminate\Http\Response
     */
    public function edit(Rodeo $rodeo)
    {
        return view('pages.administration.ganaderia.rodeos.edit', compact('rodeo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rodeo  $rodeo
     * @return \Illuminate\Http\Response
     */
    public function update(RodeoRequest $request, Rodeo $rodeo)
    {
        try {
            $rodeo = Rodeo::find($rodeo->id);
            $rodeo->rodeo_na = $request->rodeo_na;
            $rodeo->rodeo_de = $request->rodeo_de;
            DB::beginTransaction();
            $rodeo->save();
            DB::commit();
            session()->flash('my_message','Rodeo Editado Correctamente');
            return redirect ('animals/rodeo');           
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();           
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rodeo  $rodeo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rodeo $rodeo)
    {
        try {
            $rodeo = Rodeo::find($rodeo->id);
            DB::beginTransaction();
            $rodeo->delete();
            DB::commit();
            session()->flash('my_message','Rodeo ('. $rodeo->rodeo_na .' ) Eliminado!');
            return redirect()->back();           
        } catch (Exception $e) {
            session()->flash('my_error',$e->getMessage());
            DB::rollback();            
        }
    }

    public function rodeosPDF(){
        $rodeos = Rodeo::get();
        $date = date('d-m-Y');
        $pdf = PDF::loadView('pages.administration.reports.rodeos-pdf', compact('rodeos', 'date'));
        return $pdf->stream('rodeo-list-'.date('Y-m-d_H:i:s').'.pdf');
        //return view('pages.administration.reports.rodeos-pdf', compact('rodeos', 'date'));
    }
}
