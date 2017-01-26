<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;



class UserZone
{
    /**
     * Выполнение фильтра запроса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( !Auth::check()  ) {
            return Redirect::intended('/');
        }

        if ( !Auth::user()->activated ){
            Auth::logout();
            return redirect(route('login'));
        }


        return $next($request);
    }
}
