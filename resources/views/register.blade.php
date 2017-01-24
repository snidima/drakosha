@extends('layouts/main')

@section('content')
    <h1>Регистрация нового пользователя</h1>
    <form action="{{route('register')}}" method="post" class="form_login form_login_reg">
        <small class="errors">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </small>
        {{ csrf_field() }}
        <div class="row">
            <label for="inputEmail" class="col-lg-3 control-label">Email</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email" value="{{ old('email') }}">
            </div>
        </div>
        <div class="row">
            <label for="inputEmail2" class="col-lg-3 control-label">Email( снова )</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" id="inputEmail2" placeholder="Email" name="email_confirmation" value="{{ old('email_confirmation') }}">
            </div>
        </div>
        <div class="row">
            <label for="password" class="col-lg-3 control-label">Пароль</label>
            <div class="col-lg-9">
                <input type="password" class="form-control" id="password" placeholder="password" name="password" value="{{ old('password') }}">
            </div>
        </div>
        <div class="row">
            <label for="password2" class="col-lg-3 control-label">Пароль( снова )</label>
            <div class="col-lg-9">
                <input type="password" class="form-control" id="password2" placeholder="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
            </div>
        </div>
        <div class="row">
            <label for="surname" class="col-lg-3 control-label">Фамилия</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" id="surname" placeholder="Фамилия" name="surname" value="{{ old('surname') }}">
            </div>
        </div>
        <div class="row">
            <label for="name" class="col-lg-3 control-label">Имя</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" id="name" placeholder="Имя" name="name" value="{{ old('name') }}">
            </div>
        </div>
        <div class="row">
            <label for="lastname" class="col-lg-3 control-label">Отчество</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" id="lastname" placeholder="Отчество" name="lastname" value="{{ old('lastname') }}">
            </div>
        </div>
        <div class="text-right">
            <input type="submit" value="Регистрация">
        </div>

    </form>

@endsection