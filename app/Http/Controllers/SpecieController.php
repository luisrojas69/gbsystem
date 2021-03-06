<?php

namespace App\Http\Controllers;

use App\Specie;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\DB;

class SpecieController extends Controller
{
 
    public function __construct(){

        $this->middleware('can:specie.create')->only(['create', 'store']);

        $this->middleware('can:specie.index')->only(['index']);

        $this->middleware('can:specie.edit')->only(['edit', 'update']);

        $this->middleware('can:specie.show')->only(['show']);

        $this->middleware('can:specie.destroy')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $species=Specie::all();
        //dd($species);
        return view('pages.administration.ganaderia.species.index', compact('species'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('isadmin');
        return view('pages.administration.ganaderia.species.create');
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
            $specie = new Specie;
            $specie->specie_na = $request->specie_na;
            $specie->specie_de = $request->specie_de;
            DB::beginTransaction();
            $specie->save();
            DB::commit();
            session()->flash('my_message','Especie Registrada Correctamente');
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
     * @param  \App\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $specie = Specie::findOrFail($request->specie_id);
            $specie->specie_na = $request->specie_na;
            $specie->specie_de = $request->specie_de;
            DB::beginTransaction();
            $specie->save();
            DB::commit();
            session()->flash('my_message', 'Especie Modificada Correctamente');
            return redirect ('animals/specie');
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specie $specie)
    {
        try {
            $specie = Specie::find($specie->id);
            DB::beginTransaction();
            $specie->delete();
            DB::commit();
            session()->flash('my_message' , 'Especie Eliminada Corectamente');            
            return redirect ('animals/specie');
        } catch (Exception $e) {
            session('my_error', $e->getMessage());
            DB::rollback();
        }
    }
}
