<?php

namespace App\Http\Controllers;

use App\Well;
use Illuminate\Http\Request;

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
    public function index()
    {
        $wells= Well::all();
        return view('pages.administration.farming.wells.index', compact('wells'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Well  $well
     * @return \Illuminate\Http\Response
     */
    public function show(Well $well)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Well  $well
     * @return \Illuminate\Http\Response
     */
    public function edit(Well $well)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Well  $well
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Well $well)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Well  $well
     * @return \Illuminate\Http\Response
     */
    public function destroy(Well $well)
    {
        //
    }
}
