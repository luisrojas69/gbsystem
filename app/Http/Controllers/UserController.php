<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Caffeinated\Shinobi\Models\Role;

//Laravel-Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

use App\User;


class UserController extends Controller
{
    public function __construct(){

        
        //$this->middleware('can:users.create')->only(['create', 'store']);

        $this->middleware('can:user.index')->only(['index']);

        $this->middleware('can:user.edit')->only(['edit', 'update']);

        $this->middleware('can:user.show')->only(['show']);

        $this->middleware('can:user.destroy')->only(['destroy']);

    }


    public function index(Request $request)
    {
        $users= User::name($request->name)->get();
        return view('pages.administration.manager.users.index', compact('users'));
    }



    public function show (User $user)
    {
        $roles = $user->roles;
        return response()->json([$user, $roles]);   
    }


    public function destroy(User $user){
        try{
            DB::beginTransaction();
            $user->delete();
            DB::commit();
            session()->flash('my_message', 'Usuario Eliminado Correctamente');
            return redirect()->back();
        }catch(Exception $e){
            session()->flash('my_error', $e->getMessage());
            DB::rollback();
        }
    }

    public function edit(User $user){
        $roles = Role::get();
        return view('pages.administration.manager.users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, User $user){
        $user->update($request->all());

        $user->roles()->sync($request->get('roles'));
        session()->flash('my_message', 'Usuario Editado Correctamente');
        return redirect('administration/user');
    }

    //Ejecucion del Metodo que genera el Excel
    public function usersExcel(){       
        return Excel::download(new UsersExport, 'users-list-'.date('Y-m-d_H:i:s').'.xlsx');
    }

}

