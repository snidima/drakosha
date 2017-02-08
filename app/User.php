<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class User extends Authenticatable
{
    private static $defaultUserRole = 'newuser';
    private static $defaultAdminRole = 'admin';
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password','surname','lastname'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    public function codes()
    {
        return $this->hasMany('App\Code', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order','user_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer','user_id');
    }

    public function pay_checks()
    {
        return $this->hasMany('App\PayCheck','user_id');
    }
    public function createUser( array $data=[] )
    {
        $user = User::create($data);
        $role = Role::where('role', '=', self::$defaultUserRole)->first();
        $user->roles()->attach($role->id);
        return $user;
    }

    public static function isAdmin( $user )
    {
        if ( !$user ) return false;
        $role = (new Role())->where('role', '=', self::$defaultAdminRole )->first();
        $res = $role->users()->where('user_id', '=', $user->id)->first();
        return (bool) $res;
    }

    public function setPasswordAttribute($pass){

        $this->attributes['password'] = Hash::make($pass);

    }

    public static function isAvailStep( $step )
    {
        if ( !\Config::get('constants.CONCURS') ) return false;

        if ( $step == 1  ){
            return true;
        }

        if ( $step == 2  ){
            if( Auth::user()->orders()->first() )
                return true;
            else
                return false;
        }

        if ( $step == 3  ){

            if ( \App\Order::where( 'user_id', Auth::user()->id )->first() )
                $status = \App\Order::where( 'user_id', Auth::user()->id )->first()->status;
            else
                $status = false;

            return ( $status ) ? true : false;

        }

        if ( $step == 4  ){

            if ( \App\Order::where( 'user_id', Auth::user()->id )->first() )
                $status = \App\Order::where( 'user_id', Auth::user()->id )->first()->status;
            else
                $status = false;

            return ( $status ) ? true : false;

        }

        if ( $step == 5  ){


            if ( \App\Result::where( 'status', true )->first() && \App\Order::where( 'user_id', Auth::user()->id )->first()->status && User::has('answers')->first() )
                return true;
            else
                return false;

        }

    }



}
