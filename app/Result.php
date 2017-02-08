<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Result extends Model
{
    protected $table = 'results';

    protected $fillable = [
        'name', 'desc','file'
    ];

}