<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $table = 'answers';

    protected $fillable = [
        'path', 'desc'
    ];


    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


}