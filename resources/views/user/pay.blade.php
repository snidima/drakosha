@extends('layouts/main')

@section('content')


    @include('user/parts/user-nav')

    <div class="container">

        <div class="form form-small" id="user-pay" method="post">
            <div class="form__row">
                <label for="pay-method">Выбирите метод оплаты</label>
                <select id="pay-method" v-model="selectPayMethods">
                    <option v-for="pay in payMethods" v-bind:value="pay.value">@{{ pay.text }}</option>
                </select>
            </div>

            <form method="post" action="#" style="margin-top: 20px" v-if="selectPayMethods == 'ya'">

                <div class="form__row" style="margin-bottom: 0">
                    <label for="money">
                        Необходимая сумма: <span class="color1">{{$summ}}</span> руб.
                    </label>
                </div>
                <div class="form__row flex-lr flex-lr_stretch">
                    <input type="number" name="money" id="money" required placeholder="Введите сумму">
                    <button class="btn2 btn2-color1"><i class="fa fa-rub" aria-hidden="true"></i>Оплатить</button>
                </div>
            </form>

            <form method="post" action="#" style="margin-top: 20px" v-if="selectPayMethods == 'check'">
                <div class="form__row">
                    <label for="file">Прикрепите скан чека ( jpg, png )</label>
                    <input type="file" name="file" id="file" required v-on:change="fileChange">
                    <label for="file" class="file-label" v-if="file" v-bind:class="{ 'active': file }"><i class="fa fa-file" aria-hidden="true"></i>@{{ file }}</label>
                    <label for="file" class="file-label" v-else >Выбирите файл</label>
                </div>

                <div class="form__row">
                    <button class="btn2 btn2-color1" style="display: block;width: 100%"><i class="fa fa-upload" aria-hidden="true"></i>Прикрепить</button>
                </div>
            </form>

        </div>

    </div>

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-6">--}}
                {{--<form action="{{route('login')}}" class="form form-full" id="form-login" method="post" v-on:submit.prevent="send">--}}
                    {{--<div class="form__row">--}}
                        {{--<label for="email">Введите сумму( Необходимо {{$summ}} руб.  )</label>--}}
                        {{--<input type="number" name="money" id="email" required v-model="formData.email" placeholder="Введите сумму">--}}
                    {{--</div>--}}
                    {{--<div class="form__row flex-lr">--}}
                        {{--<select>--}}
                            {{--<option value="yandex">Yandex.Деньги</option>--}}
                        {{--</select>--}}
                        {{--<button class="btn2 btn2-color1"><i class="fa fa-rub" aria-hidden="true"></i>Оплатить</button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
            {{--<div class="col-md-6">--}}
                {{--<form action="{{route('login')}}" class="form form-full" id="form-login" method="post" v-on:submit.prevent="send">--}}
                    {{--<div class="form__row">--}}
                        {{--<label for="email">Оплата через Yandex.Деньги</label>--}}
                        {{--<input type="email" name="email" id="email" required v-model="formData.email" placeholder="E-mail">--}}
                    {{--</div>--}}
                    {{--<div class="form__row">--}}
                        {{--<button class="btn2 btn2-color1"><i class="fa fa-rub" aria-hidden="true"></i>Оплатить</button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


        {{--<h1 class="h1 user-header">--}}
            {{--<b class="color1">{{Auth::user()->name}}</b>, добро пожаловать!<br>--}}
            {{--<small>--}}
                {{--Изменить пароль от личного кабинета вы можете по <a href="{{route('profile')}}">ссылке</a>--}}
            {{--</small>--}}
        {{--</h1>--}}
        {{--@include('user/parts/user-nav', ['active' => '1'])--}}


        {{--<h1>--}}
            {{--Оплата<br>--}}
            {{--<small style="font-size: 16px;">Текущий баланс: {{$money}} руб.</small><br>--}}
            {{--<small style="font-size: 16px;">Заявлено сертификатов: {{$sert}} </small>--}}
        {{--</h1>--}}


        {{--<form action="{{route('user.pay')}}" method="post" class="form_login">--}}
            {{--<small class="errors">--}}
                {{--@if (count($errors) > 0)--}}
                    {{--<div class="alert alert-danger">--}}
                        {{--<ul>--}}
                            {{--@foreach ($errors->all() as $error)--}}
                                {{--<li>{{ $error }}</li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{--</small>--}}
            {{--{{ csrf_field() }}--}}
            {{--<div class="row">--}}
                {{--<label for="money" class="col-lg-3 control-label">Сумма, руб:</label>--}}
                {{--<div class="col-lg-9">--}}
                    {{--<input type="number" class="form-control" id="money" placeholder="Сумма" name="money" value="{{$summ}}">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="text-right">--}}
                {{--<input type="submit" value="Оплатить">--}}
            {{--</div>--}}
        {{--</form>--}}
        {{--<br><br>--}}
        {{--<form action="{{route('user.paycheck')}}" method="post" class="form_login" enctype="multipart/form-data">--}}
            {{--<small class="errors">--}}
                {{--@if (count($errors) > 0)--}}
                    {{--<div class="alert alert-danger">--}}
                        {{--<ul>--}}
                            {{--@foreach ($errors->all() as $error)--}}
                                {{--<li>{{ $error }}</li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{--</small>--}}
            {{--{{ csrf_field() }}--}}
            {{--<div class="row">--}}
                {{--<label for="file" class="col-lg-4 control-label">Прикрепить чек</label>--}}
                {{--<div class="col-lg-8">--}}
                    {{--<input type="file" class="form-control" id="file"  name="file">--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="text-right">--}}
                {{--@if( 1>0 )--}}
                    {{--<input type="submit" value="Прикрепить чек">--}}
                {{--@else--}}
                    {{--<input type="submit" value="Прикрепить чек">--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</form>--}}

        





@endsection