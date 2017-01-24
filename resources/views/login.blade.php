@extends('layouts/main')


@section('content')
    <h1>Войти в систему</h1>

    <form action="{{route('login')}}" method="post" class="form_login">
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
            <label for="password" class="col-lg-3 control-label">Пароль</label>
            <div class="col-lg-9">
                <input type="password" class="form-control" id="password" placeholder="Пароль" name="password" value="">
            </div>
        </div>
        <div class="text-right">
            <input type="submit" value="Войти">
        </div>
    </form>
@endsection