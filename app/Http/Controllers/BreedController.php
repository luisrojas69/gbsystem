<?php

namespace App\Http\Controllers;

use App\Breed;
use App\Specie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BreedController extends Controller
{
        
        public function __construct(){
      
        $this->middleware('can:breed.create')->only(['create', 'store']);

        $this->middleware('can:breed.index')->only(['index']);

        $this->middleware('can:breed.edit')->only(['edit', 'update']);

        $this->middleware('can:breed.show')->only(['show']);

        $this->middleware('can:breed.destroy')->only(['destroy']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breeds = Breed::all();
        $species = Specie::all();
        return view('pages.administration.ganaderia.breeds.index', compact('breeds', 'species'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $species = Specie::all();
        return view('pages.administration.ganaderia.breeds.create', compact('species'));
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
            $breed = new Breed;
            $breed->breed_na = $request->breed_na;
            $breed->breed_de = $request->breed_de;
            $breed->specie_id = $request->specie_id;
            DB::beginTransaction();
            $breed->save();
            DB::commit();
            session()->flash('my_message','Especie Registrada Correctamente');
            return back()->withInput($request->flash());          
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();           
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Breed  $breed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $breed = Breed::findOrFail($request->breed_id);
            $breed->breed_na = $request->breed_na;
            $breed->breed_de = $request->breed_de;
            $breed->specie_id = $request->specie_id;
            DB::beginTransaction();
            $breed->save();
            DB::commit();
            session()->flash('my_message', 'Raza Modificada Correctamente');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback(); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Breed  $breed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Breed $breed)
    {
        try {
            $breed = Breed::find($breed->id);
            DB::beginTransaction();
            $breed->delete();
            DB::commit();
            session()->flash('my_message', 'Raza Eliminada Correctamente');
            return redirect ('animals/breed');
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback(); 
        }
    }
}
