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
use Storage;
class UserController extends Controller
{

    public function main()
    {
        $params = [
            'newOrderAvailable' => []
        ];

        return view('user.main', [
            'params' => $params,
            'tasks'  => Task::where('status','=','1')->get()
        ] );
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

    public function getOrder()
    {
        return view('user.order',['rewards' => Order::getPossibleRewards()]);
    }

    public function getPay()
    {
        $userID = \Illuminate\Support\Facades\Auth::user()->id;

        $order = Order::whereHas( 'users' , function( $q ) use ( $userID ) {
            $q->where('user_id','=',$userID);
        } )->first() ;



        return view('user.pay',[
            'summ' => (($order->sert_count*60 - $order->money) >=0 ) ? $order->sert_count*60 - $order->money : 0 ,
            'money' => $order->money,
            'sert' => $order->sert_count,
        ]);
    }

    public function postPay( Request $request )
    {
        $userID = \Illuminate\Support\Facades\Auth::user()->id;
        $order = Order::whereHas( 'users' , function( $q ) use ( $userID ) {
            $q->where('user_id','=',$userID);
        } )->first() ;
        $order->money += $request->input('money');
        $order->save();

        return redirect(route('user'));
    }



    public function getAnswer()
    {
        $answers = Answer::whereHas('users', function ($query) {
            $query->where( 'id', '=', Auth::user()->id );
        })->get();

        return view('user.answer',['answers'=>$answers]);
    }
    public function postAnswer( Request $request )
    {
        $this->validate($request, [
            'file' => 'required|max:10240|min:10',
        ]);



        $answer = Answer::whereHas('users', function ($query) {
            $query->where( 'id', '=', Auth::user()->id );
        })->first();

        $fileName = ( !$answer ) ? uniqid().'.'.$request->file('file')->getClientOriginalExtension() : $answer->path;
        $request->file('file')->move( storage_path().'/answers/', $fileName);

        $answer = ( !$answer ) ? new Answer : $answer;
        $answer->desc = $request->input('desc') || '';
        $answer->path = $fileName;

        Auth::user()->answers()->save( $answer );

        Storage::delete( storage_path().'/answers/', $fileName );

        return redirect(route('user.answer'));

    }

}