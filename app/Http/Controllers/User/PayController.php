<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PayCheck;


class PayController extends Controller
{
    public function postPaycheck( Request $request )
    {
        $this->validate($request, [
            'file' => 'required|max:10240|min:10',
        ]);

        $answer = PayCheck::where( 'user_id', Auth::user()->id )->first();
        if ( $answer ) unlink( storage_path().'/paychecks/' . $answer->path );

        $fileName = uniqid().'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move( storage_path().'/paychecks/', $fileName );

        $answer = ( !$answer ) ? new PayCheck : $answer;
        $answer->path = $fileName;


        Auth::user()->answers()->save( $answer );

        return redirect(route('user'));
    }
}