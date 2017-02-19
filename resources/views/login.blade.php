@extends('layouts/main')

@section('title', 'Войти в систему')
@section('content')
    <div class="container">
        <h1 class="h1">Войти в систему:</h1>
        <form action="{{route('login')}}" class="form form-small" id="form-login" method="post" v-on:submit.prevent="send">
            <div class="form__row">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required v-model="formData.email" placeholder="E-mail">
            </div>
            <div class="form__row">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" required id="password" v-model="formData.password" placeholder="Пароль">
            </div>
            <div class="form__row flex-lr">
                <a href="#" onclick="return false" id="reset-btn">Забыли пароль?</a>
                <button class="btn btn-color1"><i class="fa fa-sign-in" aria-hidden="true"></i>Войти</button>
            </div>
        </form>
    </div>
@endsection