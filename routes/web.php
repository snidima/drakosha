<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
})->name('main');



Route::get('/reg', function () {

    if (Auth::check()) return redirect(route('main'));

    return view('register');
})->name('register');
Route::post('/reg', [ 'uses' => 'LoginController@postRegister' ] );




Route::get('/login', function () {

    if (Auth::check()) return redirect(route('main'));

    return view('login');
})->name('login');
Route::post('/login', [ 'uses' => 'LoginController@postLogin' ] );
Route::get('/logout', [ 'uses' => 'LoginController@logout' ] )->name('logout');









Route::group([ 'middleware' => 'auth', 'prefix'=>'userzone'], function()
{
    Route::get('/', function () {

        $params = [
            'newOrderAvailable' => \App\Order::newOrderAvailable()
        ];

        return view('user.main', ['params' => $params] );
    })->name('user');

    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');

    Route::get('/order', function () {


        $mode = ( \App\Order::newOrderAvailable() ) ? 'new' : 'edit';
        $userdata = ( $mode == 'edit' ) ? \App\Order::getForCurrentUser() : false ;

        return view('user.order',['rewards' => App\Order::getPossibleRewards(),'userdata' => $userdata, 'mode' => $mode]);
    })->name('user.order');

    Route::post('/order', [ 'uses' => 'OrderController@createOrder' ]);

    Route::post('/changePassword', [ 'uses' => 'UserController@changePassword' ] )->name('changePassword');

});







Route::group([ 'middleware' => 'admin', 'prefix'=>'adminzone'], function()
{
    Route::get('/', function (){
        return  redirect()->route('orders');
    })->name('adminzone');

    Route::get('/orders/all', function (){

        $orders = \App\Order::has( 'users' )->get() ;

        return view('admin.orders', [ 'orders' => $orders ] );
    })->name('orders');


    Route::get('/orders/{id}', function ( $id ){


        $order = \App\Order::whereHas( 'users' , function( $q ) use ( $id ) {
            $q->where('order_id','=',$id);
        } )->first() ;

//        dd($order);

        return view('admin.order', [ 'order' => $order ] );
    })->name('order');




    Route::get('/sendmail', function (){

        \Illuminate\Support\Facades\Mail::queue('emails.main', [], function($message)
        {
            $message->to('snidima@mail.ru')->subject('Новое письмо!');
        });

    });


});