<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{


    public function postLogin( Request $request )
    {
        $res = $this->validate($request, [
            'email' => 'required|max:250|email',
            'password' => 'required|min:6',
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
            return Redirect::intended('/');
        else
            return view('login')->withErrors('Error logging in!');
    }


    public function logout()
    {
        Auth::logout();
        return Redirect::intended('/');
    }



    public function postRegister( Request $request )
    {
        $this->validate($request, [
            'name' => 'required|max:100|min:2',
            'email' => 'required|unique:users|confirmed|max:250|email',
            'password' => 'required|confirmed|min:6',
            'surname' => 'required|min:2',
            'lastname' => 'required|min:2',
        ]);

        $user = (new User())->createUser([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'surname' => $request->input('surname'),
            'lastname' => $request->input('lastname'),
            'password' => bcrypt($request->input('password')),
        ]);

        Auth::login($user);

        return Redirect::intended(route('user'));
    }

}