<?php

namespace App\Http\Controllers;

use App\Paddock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaddockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paddocks = Paddock::all();
        return view('pages.administration.ganaderia.paddocks.index', compact('paddocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.administration.ganaderia.paddocks.create');
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
            $paddock = new Paddock;
            $paddock->paddock_na = $request->paddock_na;
            $paddock->paddock_de = $request->paddock_de;
            DB::beginTransaction();
            $paddock->save();
            DB::commit();
            session()->flash('my_message', 'Potrero Registrado Correctamente');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paddock  $paddock
     * @return \Illuminate\Http\Response
     */
    public function show(Paddock $paddock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paddock  $paddock
     * @return \Illuminate\Http\Response
     */
    public function edit(Paddock $paddock)
    {
        return view('pages.administration.ganaderia.paddocks.edit', compact('paddock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paddock  $paddock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paddock $paddock)
    {
        try {
            $paddock = Paddock::find($paddock->id);
            $paddock->paddock_na = $request->paddock_na;
            $paddock->paddock_de = $request->paddock_de;
            DB::beginTransaction();
            $paddock->save();
            DB::commit();
            session()->flash('my_message', 'Potrero Editado Correctamente');
            return redirect ('animals/paddock');
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.!!
     *
     * @param  \App\Paddock  $paddock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paddock $paddock)
    {
        try {
            $paddock = Paddock::find($paddock->id);
            DB::beginTransaction();
            $paddock->delete();
            DB::commit();
            session()->flash('my_message', 'Potrero Eliminado Correctamente');
            return redirect ('animals/paddock');
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }
    }
}
