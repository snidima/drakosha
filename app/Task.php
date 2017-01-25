<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Task extends Model
{

    protected $table = 'tasks';

    protected $fillable = [
        'name', 'desc','file'
    ];








}