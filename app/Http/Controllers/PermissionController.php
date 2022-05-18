<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('admin.permissions.index',['permissions'=>$permissions]);
    }

    public function store(){

        request()->validate([
            'name'=> ['required'],
        ]);
            
        Permission::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-'),
        ]);

        
        Session::flash('permission-created-message',' Permission was created');

        return back();
    }

    public function edit(Permission $permission){

        return view('admin.permissions.edit',['permission'=>$permission]);
    }

    public function update(Permission $permission){

        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');

        

        if($permission->isDirty('name')){

            Session::flash('permission-updated-message',' Permission was Updated');

            $permission->save();
        }else{

            Session::flash('permission-updated-message','Nothing changed');

        }

        return redirect()->route('permission.index');

    }

    public function destroy(Permission $permission){

        $permission->delete();

        Session::flash('permission-deleted-message',' Permission was Deleted');

        return back();

    }
}
