<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;



class RoleController extends Controller
{
    public function __construct(){

        
        //$this->middleware('can:Roles.create')->only(['create', 'store']);

        //$this->middleware('can:role.index')->only(['index']);

        //$this->middleware('can:role.edit')->only(['edit', 'update']);

        //$this->middleware('can:rodeo.show')->only(['show']);

        //$this->middleware('can:role.destroy')->only(['destroy']);

    }


    public function index()
    {
        $roles= Role::get();
        return view('pages.administration.manager.roles.index', compact('roles'));
    }


     public function create()
    {
         $permissions = Permission::get();
        return view('pages.administration.manager.roles.create', compact('permissions'));
    }

    public function store(Request $request){
        $role = Role::create($request->all());

        $role->permissions()->sync($request->get('permissions'));
        session()->flash('my_message', 'Rol Agregado Correctamente');
        return redirect('administration/role');
    }


    public function show (Role $Role)
    {
        return view('pages.administration.manager.roles.show', compact('Role'));
     
    }



    public function destroy(Role $Role){
        try{
            $Role =Role::find($Role->id);
            DB::beginTransaction();
            $Role->delete();
            DB::commit();
            session()->flash('my_message', 'Rol Eliminado Correctamente');
            return redirect()->back();
        }catch(Exception $e){
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }
    }

    public function edit(Role $role){
        $permissions = Permission::get();
        return view('pages.administration.manager.roles.edit', compact('role', 'permissions'));
    }


    public function update(Request $request, Role $role){
        $role->update($request->all());
        $role->permissions()->sync($request->get('permissions'));
        session()->flash('my_message', 'Rol Editado Correctamente');
        return redirect()->back();
    }

}

