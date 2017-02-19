@extends('layouts/main')
@section('title', 'Оплата')
@section('content')
    @include('user/parts/user-nav')
    <div class="container">
        @if( $summ > 0)
            @if( \Illuminate\Support\Facades\Auth::user()->pay_checks()->first() )
            <h2 class="pay-h2">
                Ранее вы уже загружали скан чека - <a href="{{route('download.paychecks', ['id' => \Illuminate\Support\Facades\Auth::user()->id])}}">скачать</a><br>
                <small>Повторная заграузка заменит предыдущий скан</small>
            </h2>
            @endif

            <div id="user-pay">
                <pay
                        shopid="{{env('YANDEX_SHOPID','')}}"
                        scid="{{env('YANDEXSCID','')}}"
                        action="{{env('YANDEX_URL','')}}"
                        firstaction="{{route('user.pay.online')}}"
                        userid="{{\Illuminate\Support\Facades\Auth::user()->orders()->first()->id}}"
                        summ="{{$summ}}"
                        checkaction="{{route('user.pay.check')}}"
                >
                </pay>
            </div>
        @else
            <h2 class="pay-h2">
                Конкурс оплачен.<br>
                <small>Доступное количество сертификатов: <b class="color1">{{$sert}}</b></small>
            </h2>
        @endif
    </div>
@endsection