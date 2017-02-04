@extends('layouts/main')

@section('content')
    <div class="container">
        <h1 class="h1"><b class="color1">{{Auth::user()->name}}</b>, добро пожаловать!</h1>

        @include('user/parts/user-nav')

        <p>
            Изменить настройки аккаунта вы можете по ссылке - <a href="{{route('profile')}}">настройки аккаунта</a>
        </p>

        @if( count($tasks) )
        <ul>
            @foreach( $tasks as $task )
            <li>{{$task->name}} - <a href="{{route('download.task', $task->id)}}" target="_blank">Скачать</a></li>
            @endforeach
        </ul>
        @else
            Заданий пока нет =(
        @endif
    </div>
@endsection