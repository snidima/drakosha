@extends('layouts/main')

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

    {{--@if (count($errors) > 0)--}}
        {{--<div class="alert alert-danger">--}}
            {{--<ul>--}}
                {{--@foreach ($errors->all() as $error)--}}
                    {{--<li>{{ $error }}</li>--}}
                {{--@endforeach--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--@endif--}}

    {{--@if ( Session::get('changePassword') )--}}
        {{--<div class="alert alert-success alert-dismissible" role="alert">--}}
            {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
            {{--Пароль успешно изменен!--}}
        {{--</div>--}}
    {{--@endif--}}

    {{--<form action="{{route('changePassword')}}" method="post">--}}
        {{--{{ csrf_field() }}--}}
        {{--<fieldset>--}}
            {{--<legend>Изменение пароля для {{Auth::user()->email}}</legend>--}}
            {{--<div class="form-group">--}}
                {{--<label for="old_password" class="col-lg-3 control-label">Введите старый пароль</label>--}}
                {{--<div class="col-lg-9">--}}
                    {{--<input type="password" class="form-control" id="old_password" placeholder="Старый пароль" name="old_password" value="{{ old('old_password') }}">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<label for="password" class="col-lg-3 control-label">Введите новый пароль</label>--}}
                {{--<div class="col-lg-9">--}}
                    {{--<input type="password" class="form-control" id="password" placeholder="Новый пароль" name="password" value="{{ old('password') }}">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<label for="password" class="col-lg-3 control-label">Повторите новый пароль</label>--}}
                {{--<div class="col-lg-9">--}}
                    {{--<input type="password" class="form-control" id="password" placeholder="Повторный ввод нового пароля" name="password_confirmation" value="{{ old('password_confirmation') }}">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</fieldset>--}}
        {{--<input type="submit" value="Изменить пароль">--}}
    {{--</form>--}}

@endsection