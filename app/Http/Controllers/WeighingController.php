<?php

namespace App\Http\Controllers;

use App\Weighing;
use App\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeighingController extends Controller
{
    
    public function __construct(){

        $this->middleware('can:weighing.create')->only(['create', 'store']);

        $this->middleware('can:weighing.index')->only(['index']);

        $this->middleware('can:weighing.edit')->only(['edit', 'update']);

        $this->middleware('can:weighing.show')->only(['show']);

        $this->middleware('can:weighing.destroy')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weighings = Weighing::whereHas('animal', function ($query) {
                    $query->where('rodeo_id', '=', 1);
                })->get();
        return view('pages.administration.ganaderia.weighings.index', compact('weighings'));
        //return "funcionalidad en contruccion";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($animal_id)
    {
        $animal = Animal::find($animal_id);
        return view('pages.administration.ganaderia.weighings.create', compact('animal'));
    }

    public function new_weighing()
    {
        $animals = Animal::where('rodeo_id', '1')->get();
         if (count($animals)<=0){
            session()->flash('my_error', 'No se encontraron Animales en Rodeos "Machos para Engorde"');
            return redirect()->back();
            }else{
            return view('pages.administration.ganaderia.weighings.new_weight', compact('animals'));        
            }
        
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
            $weighing = new Weighing;
            $weighing->animal_id = $request->animal_id;
            $weighing->date_read = $request->date_read;
            $weighing->weight = $request->weight;
            DB::beginTransaction();
            $weighing->save();
            DB::commit();
            session()->flash('my_message','Pesaje Registrado Correctamente para el Animal: '.$weighing->animal->animal_na);
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Weighing  $weighing
     * @return \Illuminate\Http\Response
     */
    public function show(Weighing $weighing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Weighing  $weighing
     * @return \Illuminate\Http\Response
     */
    public function edit(Weighing $weighing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Weighing  $weighing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weighing $weighing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Weighing  $weighing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weighing $weighing)
    {
        try {
        $lot=Weighing::find($weighing->id);
        DB::beginTransaction();
        $lot->delete();
        DB::commit();
        session()->flash('my_message', 'Pesaje Eliminado Correctamente');
        return redirect()->back();
        } catch (Exception $e) {
        session()->flash('my_error', $e->getMessage());    
        DB::rollback();
        }
    }
}
