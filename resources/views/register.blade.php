@extends('layouts/main')

@section('content')

    <div class="container">
        <h1 class="h1">Регистрация</h1>
        <form action="{{route('register')}}" class="form form-large" v-bind:class="{ pending: pending}" id="form-register" method="post" v-on:submit.prevent="send">
            <div class="row">
                <div class="col-md-6">
                    <div class="form__row">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" required v-model="email.value" placeholder="E-mail" v-bind:class="{ error: email.error }">
                        <p class="form__error" v-if="email.error">@{{email.error}}</p>
                    </div>
                    <div class="form__row">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" required id="password" v-model="password.value" placeholder="Пароль" v-bind:class="{ error: password.error }">
                        <p class="form__error" v-if="password.error">@{{password.error}}</p>
                    </div>

                    <div class="form__row">
                        <label for="password_confirmation">Пароль еще раз</label>
                        <input type="password" name="password_confirmation" required id="password_confirmation" v-model="password_confirmation.value" placeholder="Пароль еще раз">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form__row">
                        <label for="surname">Фамилия</label>
                        <input type="text" name="surname" required id="surname" v-model="surname.value" placeholder="Фамилия" v-bind:class="{ error: surname.error }">
                        <p class="form__error" v-if="surname.error">@{{surname.error}}</p>
                    </div>
                    <div class="form__row">
                        <label for="name">Имя</label>
                        <input type="text" name="name" required id="name" v-model="name.value" placeholder="Имя" v-bind:class="{ error: name.error }">
                        <p class="form__error" v-if="name.error">@{{name.error}}</p>
                    </div>
                    <div class="form__row">
                        <label for="lastname">Отчество</label>
                        <input type="text" name="lastname" required id="lastname" v-model="lastname.value" placeholder="Отчество" v-bind:class="{ error: lastname.error }">
                        <p class="form__error" v-if="lastname.error">@{{lastname.error}}</p>
                    </div>
                </div>
            </div>

            <div class="form__action flex-lr">
                <div class="g-recaptcha" data-sitekey="6LcVABMUAAAAAEoGqerXoZmiWtePUwtWBE7LI7lp" data-callback="recaptchaCallback" v-bind:class="{ error: 'g-recaptcha-response'.error }"></div>
                <button class="btn2 btn2-color1" disabled id="btn-send"><i class="fa fa-unlock" aria-hidden="true"></i>Регистрация</button>
            </div>
            <div class="form__pending" v-if="pending">
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
        </form>
    </div>

    {{--<h1>Регистрация нового пользователя</h1>--}}
    {{--<form action="{{route('register')}}" method="post" class="form_login form_login_reg" id="reg-form">--}}
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
                {{--<input type="password" class="form-control" id="password" placeholder="password" name="password" value="{{ old('password') }}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<label for="password2" class="col-lg-3 control-label">Пароль( снова )</label>--}}
            {{--<div class="col-lg-9">--}}
                {{--<input type="password" class="form-control" id="password2" placeholder="password" name="password_confirmation" value="{{ old('password_confirmation') }}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<label for="surname" class="col-lg-3 control-label">Фамилия</label>--}}
            {{--<div class="col-lg-9">--}}
                {{--<input type="text" class="form-control" id="surname" placeholder="Фамилия" name="surname" value="{{ old('surname') }}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<label for="name" class="col-lg-3 control-label">Имя</label>--}}
            {{--<div class="col-lg-9">--}}
                {{--<input type="text" class="form-control" id="name" placeholder="Имя" name="name" value="{{ old('name') }}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<label for="lastname" class="col-lg-3 control-label">Отчество</label>--}}
            {{--<div class="col-lg-9">--}}
                {{--<input type="text" class="form-control" id="lastname" placeholder="Отчество" name="lastname" value="{{ old('lastname') }}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="text-right">--}}
            {{--<input type="submit" value="Регистрация"  class="g-recaptcha"--}}
                   {{--data-sitekey="6LcVABMUAAAAAEoGqerXoZmiWtePUwtWBE7LI7lp"--}}
                   {{--data-callback="YourOnSubmitFn">--}}
        {{--</div>--}}

    {{--</form>--}}
    {{--<script>--}}
        {{--var YourOnSubmitFn = function(token) {--}}
            {{--var form = document.getElementById('reg-form');--}}
            {{--form.submit();--}}
        {{--};--}}
    {{--</script>--}}

@endsection