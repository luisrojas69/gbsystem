<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Variety;
use App\Crop;

class VarietyController extends Controller
{
    public function __construct(){

        $this->middleware('can:variety.create')->only(['create', 'store']);

        $this->middleware('can:variety.index')->only(['index']);
        
        $this->middleware('can:variety.edit')->only(['edit', 'update']);

        $this->middleware('can:variety.show')->only(['show']);

        $this->middleware('can:variety.destroy')->only(['destroy']);

    }

	public function index()
    {
        $varieties=Variety::all();
        $crops = Crop::select('id', 'crop_na', 'crop_de')->orderBy('id', 'ASC')->get();
    	return view('pages.administration.farming.varieties.index', compact('varieties', 'crops'));
    }


    public function create(){
        $crops = Crop::orderBy('crop_de', 'ASC')->get();
    	return view('pages.administration.farming.varieties.create', compact('crops'));
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
            return redirect('supplies/variety');
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
        return redirect('supplies/variety');
        } catch (Exception $e) {
        session()->flash('my_error', $e->getMessage());    
        DB::rollback();
        }
    }


    public function edit(Variety $variety)
    {
        $crop=Crop::all();
        return view('pages.administration.farming.varieties.edit', compact('variety','crop'));
    }

    public function update(Request $request)
    {
     try {
            $variety = Variety::findOrFail($request->variety_id);
            $variety->variety_na = $request->get('variety_na');
            $variety->variety_de = $request->get('variety_de');
            $variety->crop_id = $request->get('crop_id');
            DB::beginTransaction();
            $variety->save();
            DB::commit();
            session()->flash('my_message', 'Variedad Modificada Correctamente');
            return redirect('supplies/variety');
        } catch (Exception $e) {
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }
    }
}
