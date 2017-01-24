<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    private static $defaultUserRole = 'newuser';
    private static $defaultAdminRole = 'admin';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','surname','lastname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }


    public function createUser( array $data=[] )
    {
        $user = (User::create($data));
        $role = (new Role())->where('role', '=', self::$defaultUserRole)->first();
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
}
