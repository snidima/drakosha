@extends('layouts/main')
@section('title', 'Изменить пароль')
@section('content')
    @include('user/parts/user-nav')
    <div class="container">
        <h2 class="pay-h2">Изменить пароль</h2>
        <form action="{{route('changePassword')}}" class="form form-small" id="change-password" method="post" v-on:submit.prevent="send">
            <div class="form__row">
                <label for="old_password">Старый пароль</label>
                <input type="password" name="old_password" id="old_password" required v-model="old_password.value" placeholder="Старый пароль" v-bind:class="{ error: old_password.error }">
                <p class="form__error" v-if="old_password.error">@{{old_password.error}}</p>
            </div>
            <div class="form__row">
                <label for="password">Новый пароль</label>
                <input type="password" name="password" id="password" required v-model="password.value" placeholder="Новый пароль" v-bind:class="{ error: password.error }">
                <p class="form__error" v-if="password.error">@{{password.error}}</p>
            </div>
            <div class="form__row">
                <label for="password_confirmation">Новый пароль ( еще раз )</label>
                <input type="password" name="password_confirmation" required id="password_confirmation" v-model="password_confirmation.value" placeholder="Еще раз">
            </div>
            <div class="form__row">
                <button class="btn btn-color1"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>Сохранить</button>
            </div>
        </form>
    </div>
@endsection