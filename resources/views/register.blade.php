@extends('layouts/main')
@section('title', 'Регистрация')
@section('content')
    <div class="container" id="register">
        <h1 class="h1">Регистрация</h1>
        <register action="{{route('register')}}"></register>
    </div>
@endsection