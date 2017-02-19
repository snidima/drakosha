@extends('layouts/main')
@section('title', 'Ошибка при оплате')
@section('content')
    @include('user/parts/user-nav')
    <div class="container">
        <h2 class="pay-h2 color3">Ошибка! Платеж не прошел<br>
        <small><a href="{{route('user.pay')}}">Повторить попытку</a></small>
        </h2>
    </div>
@endsection