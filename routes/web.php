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
    return view('welcome',['html' => App\Page::where('slug', 'main')->first()->html]);
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
        return view('user.main');
    })->name('user');

    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');

    Route::get('/order', function () {
        return view('user.order',['rewards' => App\Order::getPossibleRewards()]);
    })->name('order');
    Route::post('/order', [ 'uses' => 'OrderController@createOrder' ]);

    Route::post('/changePassword', [ 'uses' => 'UserController@changePassword' ] )->name('changePassword');

});







Route::group([ 'middleware' => 'admin', 'prefix'=>'adminzone'], function()
{
    Route::get('/pages-edit', function (){
        return view('admin.main', [ 'pages' => App\Page::all() ]);
    })->name('pages-edit');

    Route::post('/save-page', function ( Request $request ){
        $page = App\Page::find( $request->input('id') );
        $page->html = $request->input('html');
        $page->save();

        Session::flash('page-edit', true);
        return redirect(route('pages-edit'));
    })->name('save-page');

});