<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;


class OrderController extends Controller
{

    public function getOrder()
    {

        if ( !Auth::user()->isAvailStep(1) ) return redirect(route('user'));

        $order = Auth::user()->orders()->first();


        if ( $order ) {

            $last = $order->created_at->addDays( \Config::get('constants.ORDER_CHANGE_DAYS') );


        } else $last = 0;




        return view('user.order',['rewards' => Order::$rewards,'order' => $order,'days' => $last]);
    }

    public function getDefault( Request $request )
    {
        $order = Auth::user()->orders()->first();
        $rewards = Order::$rewards;

        if ( $order )
            return Response::json([ 'data' => $order, 'rewards' => $rewards ], 200);
        else
            return Response::json(['rewards' => $rewards], 422);
    }
    public function createOrder( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'org_num' => 'required|integer|max:9999|min:1',
            'region' => 'required|min:3',
            'city' => 'required|min:2',
            'address' => 'required|min:2',
            'postcode' => 'required|integer|max:999999|min:100000',
            'school' => 'required',
            'sert_count' => 'required',
//            'learner' => 'required',
            'teacher_learner' => 'required',
            'phone' => 'required',
            'reward' => 'required',
        ]);

        if ( $validator->fails() )
            return Response::json($validator->getMessageBag()->toArray(), 422);

        $order = Order::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
        $order = ( $order ) ? $order : new Order;
        $order->fill( $request->all() );
        Auth::user()->orders()->save( $order );

        return Response::json([
            'success' => true,
            'redirect' => route('user')
        ], 200);;
    }

}