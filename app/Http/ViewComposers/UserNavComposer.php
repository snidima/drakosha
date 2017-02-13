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

        if( Route::currentRouteName() == 'user.task' )
            $res['task'] = 'current';
        elseif( User::isAvailStep( 3 ) )
            $res['task'] = 'avail';
        else
            $res['task'] = false;



        if( Route::currentRouteName() == 'user.answer' )
            $res['answer'] = 'current';
        elseif( User::isAvailStep( 4 ) )
            $res['answer'] = 'avail';
        else
            $res['answer'] = false;


        if( Route::currentRouteName() == 'user.results' )
            $res['results'] = 'current';
        elseif( User::isAvailStep( 5 ) )
            $res['results'] = 'avail';
        else
            $res['results'] = false;



        $view->with(['navData' => $res ]);
    }
}