<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Crop;

class CropController extends Controller
{

    public function __construct(){

        $this->middleware('can:crop.create')->only(['create', 'store']);

        $this->middleware('can:crop.index')->only(['index']);

        $this->middleware('can:crop.edit')->only(['edit', 'update']);

        $this->middleware('can:crop.show')->only(['show']);

        $this->middleware('can:crop.destroy')->only(['destroy']);

    }

    public function index()
    {	
    	$crops= Crop::all();
    	return view('pages.administration.farming.crops.index', compact('crops'));

	}

    public function create()
    {
    	return view('pages.administration.farming.crops.create');
    }

    public function show(Crop $crop)
    {
    	return 	redirect('crop');
   	}

    public function store(Request $request)
    {
    	try {	
	    
	    	$crop= New Crop;
	    	$crop->crop_na = $request->crop_na;
	    	$crop->crop_de = $request->crop_de;
	    	DB::beginTransaction();
	    	$crop->save();
	    	DB::commit();
	    	session()->flash('my_message', 'Cultivo Registrado Correctamente');
	    	return redirect('supplies/crop');
    	
    	} catch (Exception $e) {
    		
    		session()->flash('my_error', $e->getMessage());	
    		DB::rollback();
    	}	
    }

    public function destroy(Crop $crop)
    {
    	try {
    		$crop = Crop::find($crop->id);
    		DB::beginTransaction();
    		$crop->delete();
    		DB::commit();
    		session()->flash('my_message', 'Cultivo Eliminado Correctamente');
    		return redirect('supplies/crop');
    	} catch (Exception $e) {
    		session()->flash('my_error', $e->getMessage());	
    		DB::rollback();
    	}
    }

    public function edit(Crop $crop)
    {
    	return view('pages.administration.farming.crops.edit', compact('crop'));
    }

    public function update(Request $request)
    {
    	try {
    		$crop = Crop::findOrFail($request->crop_id);
    		$crop->crop_na = $request->get('crop_na');
    		$crop->crop_de = $request->get('crop_de');
    		DB::beginTransaction();
    		$crop->save();
    		DB::commit();
    		session()->flash('my_message', 'Cultivo Modificado Correctamente');
    		return redirect('supplies/crop');
    	} catch (Exception $e) {
    		session()->flash('my_error', $e->getMessage());
    		DB::rollback();
    	}
    }

}
