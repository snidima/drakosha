<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayCheck extends Model
{

    protected $table = 'pay_checks';

    protected $fillable = [
        'path', 'desc'
    ];


    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


}