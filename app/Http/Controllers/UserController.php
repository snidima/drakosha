<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function changePassword( Request $request )
    {

        if ( !Hash::check($request->old_password, Auth::user()->password) )
            return back()->withInput()->withErrors('Старый пароль введен не правильно');

        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::find( Auth::user()->id );
        $user->password = bcrypt( $request->input('password') );
        $user->save();

        Session::flash('changePassword', true);
        return redirect(route('profile'));

    }


}