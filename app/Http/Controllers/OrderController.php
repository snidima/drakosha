<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;



class OrderController extends Controller
{

    public function createOrder( Request $request )
    {
        $input = $request->toArray();

        Order::createNewOrder( $input );

        return redirect( route('user') );
    }


}