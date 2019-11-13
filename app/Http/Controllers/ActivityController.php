<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Activity;

class ActivityController extends Controller
{

    public function __construct(){
    
        $this->middleware('can:activity.create')->only(['create', 'store']);

        $this->middleware('can:activity.index')->only(['index']);

        $this->middleware('can:activity.edit')->only(['edit', 'update']);

        $this->middleware('can:activity.show')->only(['show']);

        $this->middleware('can:activity.destroy')->only(['destroy']);

    }
     
      public function index()
    {	
    	$activities= Activity::all();
    	return view('pages.administration.activities.index', compact('activities'));

	}

    public function create()
    {
    	return view('pages.administration.activities.create');
    }

    public function show(Activity $activity)
    {
    	return 	redirect('activity');
   	}

    public function store(Request $request)
    {
    	try {	
	    
	    	$activity= New Activity;
	    	$activity->activity_na = $request->activity_na;
	    	$activity->activity_de = $request->activity_de;
	    	DB::beginTransaction();
	    	$activity->save();
	    	DB::commit();
	    	session()->flash('my_message', 'Actividad Registrada Correctamente');
	    	return redirect('activity');
    	
    	} catch (Exception $e) {
    		
    		session()->flash('my_error', $e->getMessage());	
    		DB::rollback();
    	}	
    }

    public function destroy(activity $activity)
    {
    	try {
    		$activity = Activity::find($activity->id);
    		DB::beginTransaction();
    		$activity->delete();
    		DB::commit();
    		session()->flash('my_message', 'Actividad Eliminada Correctamente');
    		return redirect('activity');
    	} catch (Exception $e) {
    		session()->flash('my_error', $e->getMessage());	
    		DB::rollback();
    	}
    }

    public function edit(Activity $activity)
    {
    	return view('pages.administration.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
    	try {
    		$activity = Activity::find($activity->id);
    		$activity->activity_na = $request->get('activity_na');
    		$activity->activity_de = $request->get('activity_de');
    		DB::beginTransaction();
    		$activity->save();
    		DB::commit();
    		session()->flash('my_message', 'Variedad Modificado Correctamente');
    		return redirect('activity');
    	} catch (Exception $e) {
    		session()->flash('my_error', $e->getMessage());
    		DB::rollback();
    	}
    }
}
