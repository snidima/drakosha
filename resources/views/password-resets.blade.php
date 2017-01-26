@extends('layouts/main')


@section('content')
    <h1>Восстановление пароля</h1>


    <form action="{{route('resets')}}" method="post" class="form_login">
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
            <label for="inputEmail" class="col-lg-3 control-label">Ваш Email</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email" value="{{ old('email') }}">
            </div>
        </div>
        <div class="text-right">
            <input type="submit" value="Войти">
        </div>
    </form>
@endsection