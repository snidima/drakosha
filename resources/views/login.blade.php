@extends('layouts/main')

@section('title', 'Войти в систему')
@section('content')
    <div class="container">
        <h1 class="h1">Войти в систему:</h1>

        <form action="{{route('login')}}" class="form form-small" id="form-login" method="post" v-on:submit.prevent="send" novalidate>
            <div class="form__row">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required v-model="formData.email" placeholder="E-mail">
            </div>
            <div class="form__row">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" required id="password" v-model="formData.password" placeholder="Пароль">
            </div>
            <div class="form__row flex-lr">
                <a href="#">Забыли пароль?</a>
                <button class="btn btn-color1"><i class="fa fa-sign-in" aria-hidden="true"></i>Войти</button>
            </div>
        </form>
    </div>
@endsection

    {{--@if ( session('activated') == 'activated' )--}}
        {{--<h1>Аккаунт успешно активирован! Войдите в систему</h1>--}}
    {{--@elseif ( session('activated') == 'notactivated' )--}}
        {{--<h1>Аккаунт еще не активирован! <br>Пожалуйста, проверьте почту и следуйте инструкциям.</h1>--}}
    {{--@elseif( session('password-reset-send') == 'false' )--}}
        {{--<h1>Инструкции по восстановлению отправлены вам на почту.</h1>--}}
    {{--@elseif( session('password-reset-send') == 'true' )--}}
        {{--<h1>Инструкции по восстановлению отправлены вам на почту.</h1>--}}
    {{--@elseif( session('password-reset-save') == 'true' )--}}
        {{--<h1>Пароль успешно изменен на новый. Пожалуйста, войдите.</h1>--}}
    {{--@else--}}
        {{--<h1>Войти в систему</h1>--}}
    {{--@endif--}}

    {{--<form action="{{route('login')}}" method="post" class="form_login form-ajax">--}}
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
            {{--<label for="inputEmail" class="col-lg-3 control-label">Email</label>--}}
            {{--<div class="col-lg-9">--}}
                {{--<input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email" value="{{ old('email') }}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<label for="password" class="col-lg-3 control-label">Пароль</label>--}}
            {{--<div class="col-lg-9">--}}
                {{--<input type="password" class="form-control" id="password" placeholder="Пароль" name="password" value="">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row" style="margin: 0;padding: 0;">--}}
            {{--<div class="col-lg-3"></div>--}}
            {{--<div class="col-lg-9">--}}
                {{--<a href="{{route('resets')}}"><small>Забыли пароль?</small></a>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="text-right">--}}
            {{--<input type="submit" value="Войти">--}}
            {{--<div class="loader"></div>--}}
        {{--</div>--}}
    {{--</form>--}}
