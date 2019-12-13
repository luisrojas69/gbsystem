<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Caffeinated\Shinobi\Models\Permission;

class PermissionController extends Controller
{
    public function __construct(){


        $this->middleware('can:permission.create')->only(['create', 'store']);

        $this->middleware('can:permission.index')->only(['index']);

        $this->middleware('can:permission.edit')->only(['edit', 'update']);

        $this->middleware('can:permission.show')->only(['show']);

        $this->middleware('can:permission.destroy')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions= Permission::paginate(10);
        return view('pages.administration.manager.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function store(Request $request){
      try {
        $permission = new Permission;
        $permission->name = $request->permission_na;
        $permission->slug = $request->permission_slug;
        $permission->description = $request->permission_de;

        DB::beginTransaction();
        $permission->save();
        DB::commit();
        session()->flash('my_message', 'Permiso Creado Correctamente');
        return redirect()->back();
    } catch (Exception $e) {
        session()->flash('my_error', $e->getMessage());
        DB::rollback();
    }
}



public function destroy(Permission $permission){
    try{
        DB::beginTransaction();
        $permission->delete();
        DB::commit();
        session()->flash('my_message', 'Permiso Eliminado Correctamente');
        return redirect()->back();
    }catch(Exception $e){
        session()->flash('my_error', $e->getMessage());
        DB::rollback();
    }
}



public function update(Request $request){
  try{
      $permission = Permission::findOrFail($request->permission_id);
      $permission->name = $request->permission_na;
      $permission->slug = $request->permission_slug;
      $permission->description = $request->permission_de;
      DB::beginTransaction();
      $permission->save();
      DB::commit();
      session()->flash('my_message', 'Permiso Modificado Correctamente');
      return redirect()->back();
  }catch(Exception $e){
      session()->flash('my_error', $e->getMessage());
      DB::rollback();
  }
}
}
