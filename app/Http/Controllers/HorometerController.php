<?php

namespace App\Http\Controllers;

use App\Horometer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorometerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  \App\Horometer  $horometer
     * @return \Illuminate\Http\Response
     */
    public function show(Horometer $horometer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Horometer  $horometer
     * @return \Illuminate\Http\Response
     */
    public function edit(Horometer $horometer)
    {
        //
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
}
