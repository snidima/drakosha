@extends('layouts/main')

@section('content')

    <h3></h3>

    <form action="{{route('login')}}" method="post">
        {{ csrf_field() }}
        <fieldset>
            <legend>Изменение пароля для {{Auth::user()->email}}</legend>
            <div class="form-group">
                <label for="inputEmail" class="col-lg-3 control-label">Введите старый пароль</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-lg-3 control-label">Введите новый пароль</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="password" placeholder="Пароль" name="password" value="{{ old('password') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-lg-3 control-label">Повторите новый пароль</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="password" placeholder="Пароль" name="password" value="{{ old('password') }}">
                </div>
            </div>
            <input type="submit" value="Войти">
        </fieldset>
    </form>

@endsection