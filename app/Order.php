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
        'org_num', 'region', 'city','address','postcode', 'school', 'sert_count','learner','phone','reward','status'
    ];

    public function users() {
        return $this->belongsToMany('App\User', 'order_user', 'order_id', 'user_id')->withTimestamps();
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
        $data['status'] = 'Ожидает оплаты';

        $order = Order::create( $data );
        $order->users()->attach( Auth::user()->id  );
    }



}