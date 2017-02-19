@extends('layouts/main')
@section('title', 'Восстановление пароля')
@section('content')
    <div class="container">
        <h1 class="h1">Восстановление пароля:</h1>

        <form action="{{route('login')}}" class="form form-small" id="form-reset" method="post" v-on:submit.prevent="send">
            <div class="form__row">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" required v-model="formData.password" placeholder="Пароль">
            </div>
            <div class="form__row">
                <label for="password_confirmation">Пароль еще раз</label>
                <input type="password" name="password_confirmation" required id="password_confirmation" v-model="formData.password_confirmation" placeholder="Пароль еще раз">
            </div>
            <div class="form__row">
                <button class="btn btn-color1"><i class="fa fa-thumbs-up" aria-hidden="true"></i>Восстановить</button>
            </div>
        </form>
    </div>
@endsection