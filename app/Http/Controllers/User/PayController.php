<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\PayCheck;
use App\Order;

class PayController extends Controller
{


    public function getPay()
    {
        if ( !Auth::user()->orders()->first() ) return redirect(route('user'));
        try{
            $userID = \Illuminate\Support\Facades\Auth::user()->id;

            $order = Order::whereHas( 'users' , function( $q ) use ( $userID ) {
                $q->where('user_id','=',$userID);
            } )->first() ;

            if( !$order ) throw new Exception('Ошибка доступа');

            return view('user.pay',[
                'summ' => (($order->sert_count*\Config::get('constants.PRICE') - $order->money) >=0 ) ? $order->sert_count*\Config::get('constants.PRICE') - $order->money : 0 ,
                'money' => $order->money,
                'sert' => $order->sert_count,
            ]);
        } catch (Exception $e){
            abort('403');
        }
    }

    public function postPayOnline( Request $request )
    {
//        dd($request->all());
        $validator = Validator::make($request->all(), [
            'money' => 'required|integer|min:1',
        ]);

        if ( $validator->fails() )
            return Response::json($validator->getMessageBag()->toArray(), 422);

        $userID = \Illuminate\Support\Facades\Auth::user()->id;
        $order = Order::whereHas( 'users' , function( $q ) use ( $userID ) {
            $q->where('user_id','=',$userID);
        } )->first() ;


        $order->last_pay = $request->input('money');

//        $order->money += $request->input('money');

        $order->save();

        return Response::json([
            'success' => true,
            'message' => Auth::user()->name.', сейчас вы будете направлены на страницу оплаты.'
        ], 200);

//        return redirect(route('user.pay'));
    }

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