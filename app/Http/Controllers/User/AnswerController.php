<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Answer;


class AnswerController extends Controller
{
    public function getAnswer()
    {
        if( !Order::where('user_id',Auth::user()->id)->first()->status ) return redirect(route('user'));
        $answers = Answer::where('user_id',Auth::user()->id)->with('users')->first();

        return view('user.answer',['answers'=>$answers]);
    }
    public function postAnswer( Request $request )
    {


//        return Response::json(['res'=>$request->file('file')->getClientOriginalExtension()], 200);

        $this->validate($request, [
            'file' => 'required|max:50000|min:50|mimes:zip,rar,7z,jpeg,png',
        ]);



        $answer = Answer::where( 'user_id', Auth::user()->id )->first();
        if ( $answer ) unlink( storage_path().'/answers/' . $answer->path );

        $fileName = uniqid().'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move( storage_path().'/answers/', $fileName );

        $answer = ( !$answer ) ? new Answer : $answer;
        $answer->desc = $request->input('desc') || '';
        $answer->path = $fileName;


        Auth::user()->answers()->save( $answer );


        return Response::json([
            'success' => true,
            'redirect' => route('user')
        ], 200);

    }
}