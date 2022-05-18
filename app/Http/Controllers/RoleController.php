<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.roles.index',['roles'=>$roles]);
    }

    public function store(){

        request()->validate([
            'name'=> ['required'],
        ]);
            
        Role::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-'),
        ]);

        
        Session::flash('role-created-message',' Role was created');

        return back();
    }

    public function edit(Role $role){

        return view('admin.roles.edit',['role'=>$role,'permissions'=>Permission::all()]);
    }

    public function update(Role $role){

        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');

        

        if($role->isDirty('name')){

            Session::flash('role-updated-message',' Role was Updated');

            $role->save();
        }else{

            Session::flash('role-updated-message','Nothing changed');

        }

        return back();

    }

    public function attach(Role $role){

        $role->permissions()->attach(request('permission'));

        return back();
    }

    public function detach(Role $role){

        $role->permissions()->detach(request('permission'));

        return back();

    }


    public function destroy(Role $role){

        $role->delete();

        Session::flash('role-deleted-message','Role was deleted');

        return back();
    }
}
