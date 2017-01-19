@extends('layouts/main')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('login')}}" method="post">
        {{ csrf_field() }}
        <fieldset>
            <legend>Войти в систему</legend>
            <div class="form-group">
                <label for="inputEmail" class="col-lg-3 control-label">Введите email</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-lg-3 control-label">Введите пароль</label>
                <div class="col-lg-9">
                    <input type="password" class="form-control" id="password" placeholder="Пароль" name="password" value="{{ old('password') }}">
                </div>
            </div>
            <input type="submit" value="Войти">
        </fieldset>
    </form>
@endsection