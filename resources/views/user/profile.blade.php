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

    @if ( Session::get('changePassword') )
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Пароль успешно изменен!
        </div>
    @endif

    <form action="{{route('changePassword')}}" method="post">
        {{ csrf_field() }}
        <fieldset>
            <legend>Изменение пароля для {{Auth::user()->email}}</legend>
            <div class="form-group">
                <label for="old_password" class="col-lg-3 control-label">Введите старый пароль</label>
                <div class="col-lg-9">
                    <input type="password" class="form-control" id="old_password" placeholder="Старый пароль" name="old_password" value="{{ old('old_password') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-lg-3 control-label">Введите новый пароль</label>
                <div class="col-lg-9">
                    <input type="password" class="form-control" id="password" placeholder="Новый пароль" name="password" value="{{ old('password') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-lg-3 control-label">Повторите новый пароль</label>
                <div class="col-lg-9">
                    <input type="password" class="form-control" id="password" placeholder="Повторный ввод нового пароля" name="password_confirmation" value="{{ old('password_confirmation') }}">
                </div>
            </div>
        </fieldset>
        <input type="submit" value="Изменить пароль">
    </form>

@endsection