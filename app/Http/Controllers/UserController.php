<?php

namespace App\Http\Controllers;


use App\Answer;
use App\User;
use App\Task;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Mockery\CountValidator\Exception;

class UserController extends Controller
{

    public function main()
    {
        return view('user.main');
    }

    public function changePassword( Request $request )
    {

        if ( !Hash::check($request->old_password, Auth::user()->password) )
            return back()->withInput()->withErrors('Старый пароль введен не правильно');

        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::find( Auth::user()->id );
        $user->password = $request->input('password');
        $user->save();

        Session::flash('changePassword', true);
        return redirect(route('profile'));

    }

    public function profile()
    {
        return view('user.profile');
    }



    public function getPay()
    {

        try{
        $userID = \Illuminate\Support\Facades\Auth::user()->id;

        $order = Order::whereHas( 'users' , function( $q ) use ( $userID ) {
            $q->where('user_id','=',$userID);
        } )->first() ;

         if( !$order ) throw new Exception('Ошибка доступа');

        return view('user.pay',[
            'summ' => (($order->sert_count*60 - $order->money) >=0 ) ? $order->sert_count*60 - $order->money : 0 ,
            'money' => $order->money,
            'sert' => $order->sert_count,
        ]);
        } catch (Exception $e){
            abort('403');
        }
    }

    public function postPay( Request $request )
    {
        $userID = \Illuminate\Support\Facades\Auth::user()->id;
        $order = Order::whereHas( 'users' , function( $q ) use ( $userID ) {
            $q->where('user_id','=',$userID);
        } )->first() ;


        $order->money += $request->input('money');
        $order->save();

        return redirect(route('user.pay'));
    }


    public function getTasks()
    {

        if( !Order::where('user_id',Auth::user()->id)->first()->status ) return redirect(route('user'));
        $tasks = Task::where('status', true)->get();
        return view('user.task',['tasks' => $tasks]);

    }


}