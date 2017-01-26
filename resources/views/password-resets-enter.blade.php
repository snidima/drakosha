@extends('layouts/main')


@section('content')
    <h1>Введите новый пароль</h1>


    <form action="" method="post" class="form_login">
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
            <label for="inputPass" class="col-lg-4 control-label">Новый пароль</label>
            <div class="col-lg-8">
                <input type="password" class="form-control" id="inputEmail" placeholder="Введите новый пароль" name="password" >
            </div>
        </div>
        <div class="row">
            <label for="inputPass" class="col-lg-4 control-label">Еще раз</label>
            <div class="col-lg-8">
                <input type="password" class="form-control" id="inputEmail" placeholder="Повторите новый пароль" name="password_confirmation">
            </div>
        </div>
        <div class="text-right">
            <input type="submit" value="Войти">
        </div>
    </form>
@endsection