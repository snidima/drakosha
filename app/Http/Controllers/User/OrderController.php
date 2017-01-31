<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;


class OrderController extends Controller
{

    public function getOrder()
    {
        $order = Auth::user()->orders()->first();

        return view('user.order',['rewards' => Order::$rewards,'order' => $order]);
//        return view('user.order',['rewards' => Order::$rewards]);
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
            'learner' => 'required',
            'teacher_learner' => 'required',
            'phone' => 'required',
            'reward' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('user.order'))
                ->withErrors($validator)
                ->withInput();
        }

        $order = Order::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
        $order = ( $order ) ? $order : new Order;
        $order->fill( $request->all() );
        Auth::user()->orders()->save( $order );
        return redirect( route('user') );
    }

}