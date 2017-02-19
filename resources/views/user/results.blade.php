@extends('layouts/main')
@section('title', 'Результаты')
@section('content')

    @include('user/parts/user-nav')
    <div class="container">
        <h2 class="pay-h2">Скачайте файл с результатами: </h2>
        <ul class="user-tasks">
            @foreach($results as $task)
                <li><a href="{{route('download.results', ['id' => $task->id ])}}" class="btn2 btn2-color1"><i class="fa fa-download" aria-hidden="true"></i>{{$task->name}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection