<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;
use App\Pluviometry;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PluviometryController extends Controller
{

	    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){

        $this->middleware('can:pluviometry.create')->only(['create', 'store']);

        $this->middleware('can:pluviometry.index')->only(['index']);

        $this->middleware('can:pluviometry.edit')->only(['edit', 'update']);

        $this->middleware('can:pluviometry.show')->only(['show']);

        $this->middleware('can:pluviometry.destroy')->only(['destroy']);

    }

    protected function validatorCreate(array $data)
    {
        return Validator::make($data, [
            'value_read' => 'required|numeric',
            'sector_id' => 'required'
        ]);
    }    


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $pluviometries = Pluviometry::where('archived','=','N')->get();
        $sectors = sector::all();
        return view('pages.administration.pluviometries.index', compact('pluviometries', 'sectors'));
    }
    

    public function create()
    {
    	$sectors = sector::all();
    	return view('pages.administration.pluviometries.create', compact('sectors'));
    }


    public function store(Request $request)
    {
        $this->validatorCreate($request->all())->validate();
        try {
            $pluviometry = new Pluviometry();
            $pluviometry->date_read = $request->get('date_read');   
            $pluviometry->value_mm = (double)$request->get('value_read');
            $pluviometry->sector_id = (int)$request->get('sector_id');

            DB::beginTransaction();
            $pluviometry->save();
            DB::commit();
            session()->flash('my_message','Registro Pluviometrico Creado!');
            return redirect()->back();
            
        } catch (Exception $e) {
            session()->flash('my_error',$e->getMessage());
            DB::rollback();            
        }
    }


    public function edit(Pluviometry $pluviometry)
    {
    	$sectors= sector::all();
    	return view('pages.administration.pluviometries.edit', compact('sectors', 'pluviometry'));
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
        $this->validatorCreate($request->all())->validate();
        try {
            $pluviometry = Pluviometry::findOrFail($request->pluviometry_id);
            $pluviometry->date_read = $request->get('date_read');
            $pluviometry->value_mm = (double)$request->get('value_read');
            $pluviometry->sector_id = (int)$request->get('sector_id');

            DB::beginTransaction();
            $pluviometry->save();
            DB::commit();
            session()->flash('my_message','Registro Pluviometrico Actualizado!');
            return redirect()->route('pluviometry.index');
            
        } catch (Exception $e) {
            session()->flash('my_error',$e->getMessage());
            DB::rollback();            
        }
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pluviometry $pluviometry)
    {
        try {
            $plank = Pluviometry::find($pluviometry->id);
            DB::beginTransaction();
            $pluviometry->delete();
            DB::commit();
            session()->flash('my_message','Registro pluviometrico ('. $pluviometry->date_read .' ) Eliminado!');
            return redirect()->back();
            
        } catch (Exception $e) {
            session()->flash('my_error',$e->getMessage());
            DB::rollback();            
        }
    }


}
