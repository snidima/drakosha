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

        return view('user.main', [
            'params' => $params,
            'tasks'  => App\Task::where('status','=','1')->get()
        ] );
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

    Route::get('/pay', function () {

        $userID = \Illuminate\Support\Facades\Auth::user()->id;

        $order = App\Order::whereHas( 'users' , function( $q ) use ( $userID ) {
            $q->where('user_id','=',$userID);
        } )->first() ;



        return view('user.pay',[
            'summ' => (($order->sert_count*60 - $order->money) >=0 ) ? $order->sert_count*60 - $order->money : 0 ,
            'money' => $order->money,
            'sert' => $order->sert_count,
        ]);
    })->name('user.pay');

    Route::post('/pay', function ( Request $request ) {

        $userID = \Illuminate\Support\Facades\Auth::user()->id;
        $order = App\Order::whereHas( 'users' , function( $q ) use ( $userID ) {
            $q->where('user_id','=',$userID);
        } )->first() ;
        $order->money += $request->input('money');
        $order->save();

        return redirect(route('user'));
    });

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

        return view('admin.order', [ 'order' => $order ] );
    })->name('order');

    Route::post('/money-update', function ( Request $request ){

        try{
            $order = \App\Order::find( $request->input('id') );
            $order->money = $request->input('money');
            $order->save();
        } catch (Exception $e) {
            return redirect(route('order', $request->input('id')))->with('error', 'Баланс пользователя не обновлен!');
        }

        return redirect(route('order', $request->input('id')))->with('success', "Баланс пользователя успешно изменен на {$request->input('money')} руб.");

    })->name('order.money.update');



//    Route::get('/sendmail', function (){
//
//        \Illuminate\Support\Facades\Mail::queue('emails.main', [], function($message)
//        {
//            $message->to('snidima@mail.ru')->subject('Новое письмо!');
//        });
//
//    });


    Route::get('/tasks', function (){
        $tasks = App\Task::orderBy('updated_at','DESC')->get();
        return view('admin.tasks', [ 'tasks' => $tasks ] );
    })->name('tasks');


    Route::post('/task-edit', function ( Request $request ){

        $task = App\Task::find( $request->input('id') );

        if ( $request->input('name') ) $task->name = $request->input('name');
        if ( $request->input('desc') ) $task->desc = $request->input('desc');

        if ( $request->file('file') ) {
            $fileName = uniqid().'.'.$request->file('file')->getClientOriginalExtension();
            $request->file('file')->move( storage_path().'/tasks/', $fileName);
            $task->file = $fileName;
        }

        $task->status = $request->input('status');

        $task->save();


        return redirect(route('tasks'))->with('success', "Задание №{$task->id} успешно обнавлена.");
    })->name('task-edit');

    Route::post('/task-add', function ( Request $request ){

        if ( !$request->input('name') || !$request->file('file') )
            return redirect(route('tasks'))->with('error', 'Задание не сохранено.');

        $task = new App\Task;

        $fileName = uniqid().'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move( storage_path().'/tasks/', $fileName);

        $task->name = $request->input('name');
        $task->desc = $request->input('desc');
        $task->file = $fileName;
        $task->save();

        return redirect(route('tasks'))->with('success', 'Новое задание  успешно создано!');
    })->name('task-add');

    Route::post('/task-delete', function ( Request $request ){
        $task = App\Task::find( $request->input('id') );

        if ( $task ) $task->delete();

        return redirect(route('tasks'));
    })->name('task-delete');


});

Route::get('download/task/{id}', function ( $id )
{

    try {

        $task = App\Task::where('status','=','1')->find( $id );

        if( !$task ) throw new Exception('Доступ запрещен');

        $path = storage_path() . '/tasks/' . $task->file;

        if(!File::exists($path)) throw new Exception('Файл не существует.');

//        $file = File::get($path);
//        $type = File::mimeType($path);
//
//        $response = Response::make($file, 200);
//        $response->header("Content-Type", $type);
//        $response->header("Content-Disposition", 'inline');
//        $response->header("Content-Disposition", 'inline');

    } catch (Exception $e) {
        abort(404);
    }

//    return $response;
    return response()->download($path, $task->name.'.'.File::extension( $path ));
})->name('download.task');