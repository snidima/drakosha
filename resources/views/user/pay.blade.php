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
            <div class="form form-small" id="user-pay"  v-bind:class="{ pending: pending}">
                <div class="form__row">
                    <label for="pay-method">Выбирите метод оплаты</label>
                    <select id="pay-method" v-model="selectPayMethods">
                        <option v-for="pay in payMethods" v-bind:value="pay">@{{ pay.text }}</option>
                    </select>
                </div>
                <form method="post" id="payonline" data-first-action="{{route('user.pay.online')}}" action="{{env('YANDEX_URL','')}}" style="margin-top: 20px" v-if="selectPayMethods.type == 'online'" v-on:submit.prevent="sendOnline">
                    {{csrf_field()}}
                    <input type="hidden" value="{{env('YANDEX_SHOPID','')}}" name="shopId">
                    <input type="hidden" value="{{env('YANDEXSCID','')}}" name="scid">
                    <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::user()->orders()->first()->id}}" name="customerNumber">
                    <div class="form__row" style="margin-bottom: 0">
                        <label for="money">
                            Необходимая сумма: <span class="color1">{{$summ}}</span> руб.
                        </label>
                    </div>
                    <div class="form__row flex-lr flex-lr_stretch">
                        <input type="text" name="sum" id="sum" v-model="sum" required placeholder="Введите сумму" v-bind:class="{ error: error2 }">
                        <button class="btn2 btn2-color1"><i class="fa fa-rub" aria-hidden="true"></i>Оплатить</button>
                    </div>
                    <p class="form__error" style="text-align: left" v-if="error2">@{{error2}}</p>
                </form>
                <form method="post" id="paycheck" action="{{route('user.pay.check')}}" style="margin-top: 20px" v-if="selectPayMethods.type == 'offline'" v-on:submit.prevent="sendCheck" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form__row">
                        <label for="file">Прикрепите скан чека ( jpeg,png,zip,rar )</label>
                        <input type="file" name="file" id="file" v-on:change="fileChange">
                        <label for="file" class="file-label" v-if="file" v-bind:class="{ 'active': file, error: error }"><i class="fa fa-file" aria-hidden="true"></i>@{{ file }}</label>
                        <label for="file" class="file-label" v-else v-bind:class="{ error: error }">Выбирите файл</label>
                        <p class="form__error" v-if="error">@{{error}}</p>
                    </div>

                    <div class="form__row">
                        <button class="btn2 btn2-color1" style="display: block;width: 100%"><i class="fa fa-upload" aria-hidden="true"></i>Прикрепить</button>
                    </div>
                </form>
                <div class="form__pending" v-show="pending" style="display: none;">
                    <div class="form__pending-wrapper">
                        <div class="sk-circle">
                            <div class="sk-circle1 sk-child"></div>
                            <div class="sk-circle2 sk-child"></div>
                            <div class="sk-circle3 sk-child"></div>
                            <div class="sk-circle4 sk-child"></div>
                            <div class="sk-circle5 sk-child"></div>
                            <div class="sk-circle6 sk-child"></div>
                            <div class="sk-circle7 sk-child"></div>
                            <div class="sk-circle8 sk-child"></div>
                            <div class="sk-circle9 sk-child"></div>
                            <div class="sk-circle10 sk-child"></div>
                            <div class="sk-circle11 sk-child"></div>
                            <div class="sk-circle12 sk-child"></div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h2 class="pay-h2">
                Конкурс оплачен.<br>
                <small>Доступное количество сертификатов: <b class="color1">{{$sert}}</b></small>
            </h2>
        @endif
    </div>
@endsection