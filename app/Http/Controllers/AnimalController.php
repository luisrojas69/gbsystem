<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Specie;
use App\Breed;
use App\Paddock;
use App\Rodeo;
use App\Weighing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::all();
        return view('pages.administration.ganaderia.animals.index', compact('animals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $species = Specie::all();
        $breeds = Breed::all();
        $paddocks = Paddock::all();
        $rodeos = Rodeo::all();
        return view('pages.administration.ganaderia.animals.create', compact('species','breeds', 'paddocks', 'rodeos'));
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
            $animal = new Animal;
            $animal->animal_cod = $request->animal_cod;
            $animal->animal_na = $request->animal_na;
            $animal->animal_col = $request->animal_col;
            $animal->gender = $request->gender;
            $animal->lot_id = $request->lot_id;
            $animal->breed_id = $request->breed_id;
            $animal->date_in = $request->date_in;
            $animal->weight_in = $request->weight_in;
            $animal->condition = $request->condition;
            $animal->paddock_id = $request->paddock_id;
            $animal->rodeo_id = $request->rodeo_id;
            $animal->comment = $request->comment;
            //dd($animal);          
            DB::beginTransaction();
            $animal->save();
            DB::commit();
            session()->flash('my_message','Animal Registrado Correctamente');
            return redirect ('animals/animal');           
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {   
        $paddocks = Paddock::where("id", "!=", $animal->paddock_id)->get();
        $rodeos = Rodeo::where("id","!=",$animal->rodeo_id)->get();
        return view('pages.administration.ganaderia.animals.show', compact('animal', 'rodeos', 'paddocks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        return ("Funcionalidad de Edicion en Construccion");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal = Animal::find($animal->id);
        try {
            DB::beginTransaction();
            $animal->delete();
            DB::commit();
            Session()->flash('my_message', 'Animal Eliminado Correctamente');
            return redirect('animals/animal');
        } catch (Exception $e) {
            Session()->flash('my_error', $e->getMessage());
        }
    }

    public function MoveToRodeoCall($id)
    {
        $animal = Animal::find($id);
        $rodeos = Rodeo::where("id","!=",$animal->rodeo_id)->get();
        return view('pages.administration.ganaderia.animals.move', compact('animal', 'rodeos'));
    }

    public function MoveToRodeoExecute($animal_id, $rodeo_id)
    {
        try {
            $animal = Animal::find($animal_id);
            $animal->rodeo_id = $rodeo_id;
            DB::beginTransaction();
            $animal->save();
            DB::commit();
            session()->flash("my_message", "El Animal: ".$animal->animal_na.", fue movido al Rodeo de Animales: ".$animal->rodeo->rodeo_na);
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash("my_error", $e->getMessage());
        }   
    }


     public function MoveToPaddockExecute($animal_id, $paddock_id)
    {
        try {
            $animal = Animal::find($animal_id);
            $animal->paddock_id = $paddock_id;
            DB::beginTransaction();
            $animal->save();
            DB::commit();
            session()->flash("my_message", "El Animal: ".$animal->animal_na.", fue movido al Potrero de Animales: ".$animal->paddock->paddock_na);
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash("my_error", $e->getMessage());
        }   
    }


    public function MultiMoveToRodeoCall()
    {
        $animals = Animal::all();
        $rodeos = Rodeo::all();
        return view('pages.administration.ganaderia.animals.move_multiple', compact('animals', 'rodeos'));
    }

    public function MultiMoveToRodeoExecute(Request $request)
    {
        $ids = $request->ids;
        $rodeo_id =$request->rodeo_id;
        $rodeo = Rodeo::find($rodeo_id);

        if (is_array($ids)) 
        {
            try {   
            DB::beginTransaction();
            Animal::whereIn('id', $ids)->update(['rodeo_id' => $rodeo_id]);
            DB::commit();
            session()->flash('my_message','Animales Movidos con exito al Rodeo de Animales: '.$rodeo->rodeo_na);
            return redirect()->back();       
            } catch (Exception $e) {
                session()->flash('my_error',$e->getMessage());
                DB::rollback();            
            }
        }
         session()->flash('my_error','Seleccione al Menos un Animal y un Rodeo');
         return redirect()->back();
    }


}
