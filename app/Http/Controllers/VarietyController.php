<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Variety;
use App\Crop;

class VarietyController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('isadmin');
    }


	public function index()
    {
        $varieties=Variety::all();
    	return view('pages.administration.varieties.index', compact('varieties'));
    }


    public function create(){
        $crops = Crop::orderBy('crop_de', 'ASC')->get();
    	return view('pages.administration.varieties.create', compact('crops'));
    }

    
    public function show (Variety $variety)
    {
        return view('pages.administration.varieties.show', compact('variety'));
    }


    public function store(Request $request){

        try {
            $variety = new Variety;
            $variety->variety_na = $request->variety_na;
            $variety->variety_de = $request->variety_de;
            $variety->crop_id= $request->crop_id;

            DB::beginTransaction();
            $variety->save();
            DB::commit();
            session()->flash('my_message', 'Variedad Creada Correctamente');
            return redirect('variety');
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }

    }


    public function destroy(Variety $variety)
    {
        try {
        $variety=Variety::find($variety->id);
        DB::beginTransaction();
        $variety->delete();
        DB::commit();
        session()->flash('my_message', 'Variedad Eliminada Correctamente');
        return redirect('variety');
        } catch (Exception $e) {
        session()->flash('my_error', $e->getMessage());    
        DB::rollback();
        }
    }


    public function edit(Variety $variety)
    {
        $crop=Crop::all();
        return view('pages.administration.varieties.edit', compact('variety','crop'));
    }

    public function update(Request $request, Variety $variety)
    {
        try {
            $variety = Variety::find($variety->id);
            $variety->variety_na = $request->get('variety_na');
            $variety->variety_de = $request->get('variety_de');
            DB::beginTransaction();
            $variety->save();
            DB::commit();
            session()->flash('my_message', 'variedad Modificada Correctamente');
            return redirect('variety');
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }
    }
}
