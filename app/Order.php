<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Order extends Model
{

    protected $table = 'orders';

    protected $fillable = [
        'org_num', 'region', 'city','address','postcode', 'school', 'sert_count','learner','phone','reward','teacher_learner'
    ];

    protected $guarded = ['money','status'];

//    public function users()
//    {
//        return $this->belongsToMany('App\User', 'order_user', 'order_id', 'user_id')->withTimestamps();
//    }

    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    static function getPossibleRewards()
    {
        $type = DB::select( DB::raw("SHOW COLUMNS FROM orders WHERE Field = 'reward'") )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enum = array_add($enum, $v, $v);
        }
        return $enum;
    }

    static function createNewOrder( $data = [] )
    {

        $order = new Order;
        $order->fill( $data );
        $order->status = 'Ожидает оплаты';
        $order->money = '0';
        Auth::user()->orders()->save( $order );
    }

    static function newOrderAvailable()
    {
        $ordersCount = Order::whereHas( 'users', function($q){
            $q->where( 'user_id','=', \Illuminate\Support\Facades\Auth::user()->id );
        } )->count();

        return ( $ordersCount > 0 ) ? false : true;
    }

    static function getForCurrentUser()
    {
        $order = Order::whereHas( 'users', function($q){
            $q->where( 'user_id','=', \Illuminate\Support\Facades\Auth::user()->id );
        } )->first();

        return $order;
    }




}