@extends('layouts/main')

@section('content')

@include('user/parts/user-nav')

   <div class="container">


       @if(count($tasks)>0)
           <h2 class="pay-h2">Задания доступные для скачивания: </h2>
           <ul class="user-tasks">
               @foreach($tasks as $task)
                   <li><a href="{{route('download.task', ['id' => $task->id ])}}" class="btn2 btn2-color1"><i class="fa fa-download" aria-hidden="true"></i>{{$task->name}}</a></li>
               @endforeach
           </ul>
       @else
           <h2 class="pay-h2">К сожалению, заданий для скачивания нет.</h2>
       @endif


   </div>

@endsection