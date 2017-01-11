@extends('layouts/main')

@section('content')


    <form action="{{route('register')}}" method="post">
        {{ csrf_field() }}
        <fieldset>
            <legend>Регистрация нового пользователя</legend>
            <div class="form-group">
                <label for="inputEmail" class="col-lg-3 control-label">Email</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail2" class="col-lg-3 control-label">Email( снова )</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="inputEmail2" placeholder="Email" name="email2">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-lg-3 control-label">Пароль</label>
                <div class="col-lg-9">
                    <input type="password" class="form-control" id="password" placeholder="password" name="password">
                </div>
            </div>
            <div class="form-group">
                <label for="password2" class="col-lg-3 control-label">Пароль( снова )</label>
                <div class="col-lg-9">
                    <input type="password" class="form-control" id="password2" placeholder="password" name="password2">
                </div>
            </div>
            <div class="form-group">
                <label for="surname" class="col-lg-3 control-label">Фамилия</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="surname" placeholder="Фамилия" name="surname">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-lg-3 control-label">Имя</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="name" placeholder="Имя" name="name">
                </div>
            </div>
            <div class="form-group">
                <label for="surname2" class="col-lg-3 control-label">Отчество</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" id="surname2" placeholder="Отчество" name="surname2">
                </div>
            </div>
            <input type="submit" value="Регистрация">
        </fieldset>
    </form>

@endsection