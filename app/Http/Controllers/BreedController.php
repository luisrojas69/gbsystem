<?php

namespace App\Http\Controllers;

use App\Breed;
use App\Specie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BreedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breeds = Breed::all();
        return view('pages.administration.ganaderia.breeds.index', compact('breeds'));
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
     * Display the specified resource.
     *
     * @param  \App\Breed  $breed
     * @return \Illuminate\Http\Response
     */
    public function show(Breed $breed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Breed  $breed
     * @return \Illuminate\Http\Response
     */
    public function edit(Breed $breed)
    {
        return view('pages.administration.ganaderia.breeds.edit', compact('breed'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Breed  $breed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Breed $breed)
    {
        try {
            $breed = Breed::find($breed->id);
            $breed->breed_na = $request->breed_na;
            $breed->breed_de = $request->breed_de;
            $breed->specie_id = $request->specie_id;
            DB::beginTransaction();
            $breed->save();
            DB::commit();
            session()->flash('my_message', 'Raza Modificada Correctamente');
            return redirect ('animals/breed');
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
