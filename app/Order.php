<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    public static $rewards = [
        'Сертификат-онлайн',
        'Почта России',
    ];



    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->money = 0;
        });
    }

    protected $table = 'orders';

    protected $fillable = [
        'org_num', 'region', 'city','address','postcode', 'school', 'sert_count','learner','phone','reward','teacher_learner'
    ];

    protected $guarded = ['money'];

    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public  function getStatusAttribute()
    {
        $sert = $this->sert_count;
        $money = $this->money;

        if ( ($sert*60 - $money) > 0 )
            return false;
        else
            return true;

    }

    public  function getNeedMoneyAttribute()
    {
        $sert = $this->sert_count;
        $money = $this->money;

        if ( ($sert*60 - $money) > 0 )
            return $sert*60 - $money;
        else
            return 0;

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