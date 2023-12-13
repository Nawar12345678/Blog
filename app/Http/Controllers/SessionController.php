<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class SessionController extends Controller
{
    public function create(){
        return view('login');
    }

    public function store(Request $request){
        if(! auth()->attempt(request(['email', 'password'])))
        {
            return back()->withErrors([
                'massage' => 'Email or  password not correct ',
            ]);
        }
        return redirect('/posts');

    }

    public function destroy(){
        auth()->logout();
        return redirect('/posts');

    }
}
