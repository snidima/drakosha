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









Route::group([ 'middleware' => 'auth', 'prefix'=>'user'], function()
{
    Route::get('/', function () {
        return view('user.main');
    })->name('user');

    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');

    Route::post('/changePassword', [ 'uses' => 'UserController@changePassword' ] )->name('changePassword');

});







Route::group([ 'middleware' => 'admin', 'prefix'=>'admin'], function()
{
    Route::get('/', function (){
        return 'ok';
    });
});