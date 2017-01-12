<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\User;


class AdminZone
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
        if ( !User::isAdmin( Auth::user() ) ) {
            return Redirect::intended('/');
        }

        return $next($request);
    }
}
