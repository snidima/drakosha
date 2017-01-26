<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassReset extends Model
{
    protected $table = 'password_resets';
    protected $fillable = ['token, email'];
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
}
