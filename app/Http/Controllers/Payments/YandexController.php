<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Answer;


class YandexController extends Controller
{
    public function checkUrl()
    {
        echo __METHOD__;
    }

    public function avisoUrl()
    {
        echo __METHOD__;
    }

    public function shopSuccessUrl()
    {
        echo __METHOD__;
    }

    public function shopFailUrl()
    {
        echo __METHOD__;
    }


    /////////////////////DEMO


    public function checkUrlDemo()
    {
        echo __METHOD__;
    }

    public function avisoUrlDemo()
    {
        echo __METHOD__;
    }

    public function shopSuccessUrlDemo()
    {
        echo __METHOD__;
    }

    public function shopFailUrlDemo()
    {
        echo __METHOD__;
    }

}