<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Log;

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

    public function check( $action, $request )
    {
		$action = $action;
		$orderSumAmount =  Order::find($request->input('customerNumber'))->last_pay.'.00';
		$orderSumCurrencyPaycash =  $request->input('orderSumCurrencyPaycash');
		$orderSumBankPaycash =  $request->input('orderSumBankPaycash');
		$shopId =  env('YANDEX_SHOPID','');
		$invoiceId =  $request->input('invoiceId');
		$customerNumber =  $request->input('customerNumber');
		$shopPassword =  'TKzKtbu6lTvoAVXRM50';

		$realHash = strtoupper( MD5("$action;$orderSumAmount;$orderSumCurrencyPaycash;$orderSumBankPaycash;$shopId;$invoiceId;$customerNumber;$shopPassword") );

		$yandexHash = strtoupper( $request->input('md5') );

		if ( $realHash != $yandexHash )
			return false;
		else 
			return true;
    }


    public function checkUrlDemo( Request $request )
    {

			$time = date(DATE_ATOM);

			if( !$this->check( 'checkOrder', $request ) ) {

	    		Log::warning('Заявка №'.Order::find($request->input('customerNumber'))->id.' ошибка при оплате');
				echo '<?xml version="1.0" encoding="UTF-8"?><checkOrderResponse performedDatetime="'.$time.'" code="1" invoiceId="'.$request->input('invoiceId').'" shopId="'.env('YANDEX_SHOPID','').'"/>';
			
	    	} else {

    			echo '<?xml version="1.0" encoding="UTF-8"?><checkOrderResponse performedDatetime="'.$time.'" code="0" invoiceId="'.$request->input('invoiceId').'" shopId="'.env('YANDEX_SHOPID','').'"/>';
    			
	    	}

    }

    public function avisoUrlDemo( Request $request )
    {
        Log::info('Поступил запрос от Яндекса со следующими данными:');
        Log::info( $request->all() );

        $time = date(DATE_ATOM);


		if( $this->check( 'paymentAviso', $request ) ) {

			$order = Order::find($request->input('customerNumber'));
			$order->money+= $request->input('orderSumAmount');
			$order->save();

    		echo '<?xml version="1.0" encoding="UTF-8"?><paymentAvisoResponse  performedDatetime="'.$time.'" code="0" invoiceId="'.$request->input('invoiceId').'" shopId="'.env('YANDEX_SHOPID','').'"/>';
		
    	} 



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