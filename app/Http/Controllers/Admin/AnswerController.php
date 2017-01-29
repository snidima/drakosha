<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AnswerController extends Controller
{

    public function answers()
    {
        $answers = Answer::has('users')->get();
//        dd($answers);
        return  view('admin.answers',['answers' => $answers]);
    }

}