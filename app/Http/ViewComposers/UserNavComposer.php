<?php namespace App\Http\ViewComposers;


use Illuminate\Contracts\View\View;
use App\User;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class UserNavComposer {


    public function compose($view)
    {
//        $order = Auth::user()->orders()->first();

//        dd( User::isAvailStep(2) );

        $res = [];

        if( Route::currentRouteName() == 'user.order' )
            $res['order'] = 'current';
        elseif( User::isAvailStep( 1 ) )
            $res['order'] = 'avail';
        else
            $res['order'] = false;

        if( Route::currentRouteName() == 'user.pay' )
            $res['pay'] = 'current';
        elseif( User::isAvailStep( 2 ) )
            $res['pay'] = 'avail';
        else
            $res['pay'] = false;






        $view->with(['navData' => $res ]);
    }
}