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

Route::get('/payments', function () {
    return view('payments');
})->name('payments');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/how', function () {
    return view('how');
})->name('how');


Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');


Route::group([ 'prefix'=>'/payments/system/yandex'], function()
{
    Route::post('/check', ['uses'=>'Payments\YandexController@checkUrl']);
    Route::post('/aviso', ['uses'=>'Payments\YandexController@avisoUrl']);

    Route::post('/demo/check', ['uses'=>'Payments\YandexController@checkUrlDemo']);
    Route::post('/demo/aviso', ['uses'=>'Payments\YandexController@avisoUrlDemo']);

});





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



Route::post('/feedback', [ 'uses' => 'FeedbackController@create' ] )->name('feedback');





Route::group([ 'middleware' => 'user', 'prefix'=>'userzone'], function()
{

    Route::get('/', ['uses' => 'UserController@main'])->name('user');
    Route::get('/profile', ['uses' => 'UserController@profile'])->name('profile');

    Route::get('/order', ['uses'=>'User\OrderController@getOrder'])->name('user.order');
    Route::post('/order', ['uses' => 'User\OrderController@createOrder' ]);
    Route::post('/order/getDefault', ['uses' => 'User\OrderController@getDefault' ]);

    Route::post('/changePassword', [ 'uses' => 'UserController@changePassword' ] )->name('changePassword');

    Route::get('/pay', [ 'uses' => 'User\PayController@getPay' ])->name('user.pay');
    Route::post('/payonline', [ 'uses' => 'User\PayController@postPayOnline' ])->name('user.pay.online');
    Route::post('/paycheck', [ 'uses' => 'User\PayController@postPaycheck' ])->name('user.pay.check');

    Route::get('/gettask', [ 'uses' => 'UserController@getTasks' ])->name('user.task');

    Route::get('/answer', [ 'uses' => 'User\AnswerController@getAnswer' ])->name('user.answer');
    Route::post('/answer', [ 'uses' => 'User\AnswerController@postAnswer' ]);

    Route::get('/results', [ 'uses' => 'User\ResultsController@getResults' ])->name('user.results');

    Route::get('/pay/success', ['uses'=>'Payments\YandexController@shopSuccessUrl']);
    Route::get('/pay/fail', ['uses'=>'Payments\YandexController@shopFailUrl']);
    Route::get('/pay/demo/success', ['uses'=>'Payments\YandexController@shopSuccessUrlDemo']);
    Route::get('/pay/demo/fail', ['uses'=>'Payments\YandexController@shopFailUrlDemo']);

});







Route::group([ 'middleware' => 'admin', 'prefix'=>'adminzone'], function()
{
    Route::get('/', ['uses'=>'Admin\OrderController@orders'])->name('adminzone');



    Route::get('/results', ['uses'=>'Admin\ResultController@index'])->name('admin.results');
    Route::post('/results-add', ['uses'=>'Admin\ResultController@create'])->name('admin.results.add');
    Route::post('/results-update', ['uses'=>'Admin\ResultController@update'])->name('admin.results.update');
    Route::post('/results-delete', ['uses'=>'Admin\ResultController@delete'])->name('admin.results.delete');



    Route::get('/answers', ['uses'=>'Admin\AnswerController@answers'])->name('admin.answers');

    Route::get('/orders/all', function (){


        $users = App\User::has('orders')->with('answers')->with('pay_checks')->get() ;

//        dd( $users[0]-> );

        return view('admin.orders', [ 'users' => $users ] );
    })->name('orders');


    Route::get('/order/{id}', function ( $id ){


        $order = \App\Order::where( 'user_id', $id )->with('users')->first();
//        dd($order->users->name);
        $paycheck = $order->users->id;

//        dd( $paycheck );

        return view('admin.order', [ 'order' => $order , 'paycheck' => $paycheck ] );
    })->name('order');

    Route::post('/money-update', function ( Request $request ){

        try{
            $order = \App\Order::find( $request->input('id') );
            $order->money = $request->input('money');
            $order->save();
        } catch (Exception $e) {
            return redirect(route('order', $request->input('id')))->with('error', 'Баланс пользователя не обновлен!');
        }

        return redirect(route('order', \Illuminate\Support\Facades\Auth::user()->id))->with('success', "Баланс пользователя успешно изменен на {$request->input('money')} руб.");

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

        $task = App\Task::where('status', true)->find( $id );

        if( !$task ) throw new Exception('Доступ запрещен');


        if ( !(\App\User::isAdmin(\Illuminate\Support\Facades\Auth::user()) || \App\Order::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->first()->status) )
            throw new Exception('Доступ запрещен');


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
            $answer = App\Answer::where('user_id',$id)->first();
        } else {
            $answer = App\Answer::where('user_id','=', $id)->first( $id );
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


Route::get('download/paycheck/{id}', function ( $id )
{
    try {

        if ( \App\User::isAdmin( \Illuminate\Support\Facades\Auth::user() ) ){
            $answer = App\PayCheck::where('user_id',$id)->first();
        } else {
            $answer = App\PayCheck::where('user_id', $id)->first();
        }

//        dd($answer);

        if( !$answer ) throw new Exception('Доступ запрещен');

        $path = storage_path() . '/paychecks/' . $answer->path;

        if(!File::exists($path)) throw new Exception('Файл не существует.');

    } catch (Exception $e) {
        abort(404);
    }
    $fileName =
        $answer->users()->first()->name.' '.
        $answer->users()->first()->surname;

    return response()->download($path, $fileName.'.'.File::extension( $path ));
})->name('download.paychecks');






Route::get('download/results/{id}', function ( $id )
{

    try {

        $task = App\Result::where('status', true)->find( $id );

        if( !$task ) throw new Exception('Доступ запрещен');


        if ( !(\App\User::isAdmin(\Illuminate\Support\Facades\Auth::user()) || \App\Order::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->first()->status) )
            throw new Exception('Доступ запрещен');


        $path = storage_path() . '/results/' . $task->file;

        if(!File::exists($path)) throw new Exception('Файл не существует.');

    } catch (Exception $e) {
        abort(404);
    }

    return response()->download($path, $task->name.'.'.File::extension( $path ));
})->name('download.results');