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

Route::get('/test', function (){
    Bugsnag::notifyError('ErrorType', 'Test Error');
});
Route::get('/', function () {
    return view('welcome');
})->name('main');





Route::get('/register', [ 'uses' => 'AuthController@getRegister' ] )->name('register');
Route::post('/register', [ 'uses' => 'AuthController@postRegister' ] );
Route::get('/login', [ 'uses' => 'AuthController@getLogin' ] )->name('login');;
Route::post('/login', [ 'uses' => 'AuthController@postLogin' ] );
Route::get('/logout', [ 'uses' => 'AuthController@logout' ] )->name('logout');
Route::get('/resets', [ 'uses' => 'AuthController@getResets' ] )->name('resets');
Route::post('/resets', [ 'uses' => 'AuthController@postResets' ] );
Route::get('/activate/{id}/{code}', [ 'uses' => 'AuthController@activate' ] )->name('activate');
Route::get('/resets/{email}/{code}', [ 'uses' => 'AuthController@getResetsCheck' ] )->name('resets.check');
Route::post('/resets/{email}/{code}', [ 'uses' => 'AuthController@postResetsCheck' ] );





Route::group([ 'middleware' => 'user', 'prefix'=>'userzone'], function()
{

    Route::get('/', ['uses' => 'UserController@main'])->name('user');
    Route::get('/profile', ['uses' => 'UserController@profile'])->name('profile');

    Route::get('/order', ['uses'=>'User\OrderController@getOrder'])->name('user.order');
    Route::post('/order', ['uses' => 'User\OrderController@createOrder' ]);

    Route::post('/changePassword', [ 'uses' => 'UserController@changePassword' ] )->name('changePassword');
    Route::get('/pay', [ 'uses' => 'UserController@getPay' ])->name('user.pay');
    Route::post('/pay', [ 'uses' => 'UserController@postPay' ]);
    Route::get('/answer', [ 'uses' => 'UserController@getAnswer' ])->name('user.answer');
    Route::post('/answer', [ 'uses' => 'UserController@postAnswer' ]);

});







Route::group([ 'middleware' => 'admin', 'prefix'=>'adminzone'], function()
{
    Route::get('/', ['uses'=>'Admin\OrderController@orders'])->name('adminzone');

    Route::get('/answers', ['uses'=>'Admin\AnswerController@answers'])->name('admin.answers');

    Route::get('/orders/all', function (){


        $orders = App\Order::with('users')->get() ;

        return view('admin.orders', [ 'orders' => $orders ] );
    })->name('orders');


    Route::get('/orders/{id}', function ( $id ){


        $order = \App\Order::find( $id ) ;

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

    } catch (Exception $e) {
        abort(404);
    }

    return response()->download($path, $task->name.'.'.File::extension( $path ));
})->name('download.task');


Route::get('download/answer/{id}', function ( $id )
{
    try {

        if ( \App\User::isAdmin( \Illuminate\Support\Facades\Auth::user() ) ){
            $answer = App\Answer::has('users')->find( $id );
        } else {
            $answer = App\Answer::where('user_id','=', \Illuminate\Support\Facades\Auth::user()->id)->find( $id );
        }



        if( !$answer ) throw new Exception('Доступ запрещен');

        $path = storage_path() . '/answers/' . $answer->path;

        if(!File::exists($path)) throw new Exception('Файл не существует.');

    } catch (Exception $e) {
        abort(404);
    }
    $fileName =
        $answer->users()->first()->name.' '.
        $answer->users()->first()->surname;

    return response()->download($path, $fileName.'.'.File::extension( $path ));
})->name('download.answer');