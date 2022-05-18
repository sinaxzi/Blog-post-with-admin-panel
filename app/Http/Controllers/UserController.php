<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(){

        $users = User::all();
        return view('admin.users.index',['users'=>$users]);
    }

    public function show(User $user ){
        return view('admin.users.profile',['user'=>$user,'roles'=>Role::all()]);
    }

    public function update(User $user){

        $inputs = request()->validate([
            'username'=> ['required','max:255','string','alpha_dash'],
            'name'=> ['required','max:255','string'],
            'email'=> ['required','max:255','email'],
            'avatar'=>['file']
        ]);

        if(request('avatar')){
            $inputs['avatar'] = request('avatar')->store('IMAGES');
        }

        $user->update($inputs);

        return back();


    }

    public function destroy(User $user){

        $user->delete();

        Session::flash('user-deleted-message','User was deleted');

        return back();

    }

    public function attach(User $user){

        $user->roles()->attach(request('role'));

        return back();
    }

    public function detach(User $user){

        $user->roles()->detach(request('role'));

        return back();
    }
}


