<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\PayCheck;


class PayController extends Controller
{
    public function postPaycheck( Request $request )
    {
        $this->validate($request, [
            'file' => 'required|max:50000|min:50|mimes:jpeg,png,zip,rar',
        ]);

        $answer = PayCheck::where( 'user_id', Auth::user()->id )->first();
        if ( $answer ) unlink( storage_path().'/paychecks/' . $answer->path );

        $fileName = uniqid().'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move( storage_path().'/paychecks/', $fileName );

        $answer = ( !$answer ) ? new PayCheck : $answer;
        $answer->path = $fileName;


        Auth::user()->answers()->save( $answer );

        return Response::json([
            'success' => true,
            'redirect' => route('user')
        ], 200);
    }
}