<?php

namespace App\Http\Controllers;

use App\PassReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Code;
use App\User;
use Illuminate\View\View;

class AuthController extends Controller
{

    public function postRegister( Request $request, User $user )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|min:2',
            'email' => 'required|unique:users|max:100|email',
            'password' => 'required|confirmed|min:6',
            'surname' => 'required|min:2',
            'lastname' => 'required|min:2',
        ]);

        if ( $validator->fails() )
            return Response::json($validator->getMessageBag()->toArray(), 422);

//            return redirect()
//                ->route('register')
//                ->withErrors($validator)
//                ->withInput();



        $recaptcha = false;
        if( $curl = curl_init() ) {
            curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, "secret=	6LcVABMUAAAAAObjmOhr7xGknunxnt5r3IEzpnLj&response={$request->input('g-recaptcha-response')}");
            $recaptcha = json_decode(curl_exec($curl));
            curl_close($curl);
        }

        if ( !$recaptcha->success )
            return Response::json(['g-recaptcha-response' => ['Нужно пройти проверку'] ], 422);

        $user = $user->createUser( $request->all() );

        $code = new Code;
        $code->code = str_random(80);
        $user->codes()->save($code);

        $url = route('activate',['id'=>$user->id,'code'=> $code->code]);
        Mail::send('emails.registration', array('url' => $url), function($message) use ($request)
        {
            $message->to($request->email)->subject('Регистрация на drakosha-olimpiada.ru');
        });

        return Response::json([
            'success' => true,
            'redirect' => route('login')
        ], 200);

    }


    public function activate( $id, $code )
    {
        $activate = User::find($id)->codes->first()->code;

        if( !$activate ) return redirect(route('main'));

        if ( $code == $activate ){
            $user = User::find($id);
            if ( $user->activated ) return redirect(route('main'));
            $user->activated = true;
            $user->save();
            Code::where('user_id',$user->id)->delete();
            return redirect(route('login'))->with('activated', 'activated');
        } else {
            return redirect(route('main'));
        }

    }

    public function getRegister()
    {
        return view('register');
    }


    public function getLogin()
    {
        if (Auth::check()) return redirect(route('user'));

        return view('login');
    }


    public function postLogin( Request $request )
    {
//        sleep(5);
        $res = $this->validate($request, [
            'email' => 'required|max:250|email',
            'password' => 'required|min:6',
        ]);



        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'activated' => true,
        ], true))
            return redirect(route('user'));
        else
            return view('login')->withErrors('Данные не корректны или аккаунт не активирован!');
    }



    public function logout()
    {
        Auth::logout();
        return back();
    }




    public function postResets( Request $request )
    {
        $res = $this->validate($request, [
            'email' => 'required|max:250|email',
        ]);

        $user = User::where('email','=',$request->input('email'))->first();

        if ( !$user ) return redirect(route('login'))->with('password-reset-send', 'false');

        $reset = new PassReset;
        $reset->email = $request->input('email');
        $reset->token = str_random(80);
        $reset->save();
        $url = route('resets.check', ['email' => $request->input('email'), 'code' => $reset->token]);
         Mail::send('emails.registration', array('url' => $url), function($message) use ($request)
         {
             $message->to($request->email)->subject('Восстановление пароля на ДРАКОШЕ.');
         });

        return redirect(route('login'))->with('password-reset-send', 'true');

    }
    public function getResets()
    {
        return view('password-resets');
    }

    public function getResetsCheck( $email, $code )
    {
        return view('password-resets-enter');
    }

    public function postResetsCheck( $email, $code, Request $request )
    {
        $res = $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('email','=',$email)->first();
        $reset = PassReset::where('email','=',$email)->orderBy('created_at','DESC')->first();

        if ( $user && $reset ){
            $user->password = $request->input('password');
            $user->save();
            $reset->delete();
        }

        return redirect(route('login'))->with('password-reset-save', 'true');


    }




}
