<?php

namespace App\Http\Controllers\User;

use App\Result;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\PayCheck;



class ResultsController extends Controller
{

    public function getResults()
    {
        if ( !User::isAvailStep(5) ) return redirect(route('user'));
        return view('user.results',['results' => Result::where('status', true)->get()]);
    }

}