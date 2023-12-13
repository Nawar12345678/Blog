<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Schema;

class RegisterController extends Controller
{
    public function create(){
        return view('register');
    }

    public function store(Request $request){

        //create user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

//Add role
$user->roles()->attach(Role:: where('name', 'User')->first());



         //login
        auth()->login($user);



         //redirect

        return redirect('/posts');

    }
}
