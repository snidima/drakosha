@extends('layouts/main')

@section('content')

    <h1>{{Auth::user()->name}}, добро пожаловать в Ваш личный раздел<br> на нашем сайте!</h1>




    <div class="circles text-center">
        @if( $params['newOrderAvailable'] )
            <div class="cricle" data-coor="green">
                <a href="{{route('user.order')}}" class="cricle-text">
                    <div class="cricle-text__title">Подать заявку</div>
                </a>
            </div>
        @else
            <div class="cricle" data-coor="blue">
                <a href="{{route('user.order')}}" class="cricle-text">
                    <div class="cricle-text__title">Редактировать заявку</div>
                </a>
            </div>
        @endif

        @if( $params['newOrderAvailable'] )
            <div class="cricle" data-coor="gray">
                <div class="cricle-text">
                    <div class="cricle-text__title">Оплатить</div>
                </div>
            </div>
        @else
            <div class="cricle" data-coor="green">
                <a href="{{route('user.pay')}}" class="cricle-text">
                    <div class="cricle-text__title">Оплатить</div>
                </a>
            </div>
        @endif

        <div class="cricle" data-coor="gray">
            <div class="cricle-text">
                <div class="cricle-text__title">Отправить ответы</div>
            </div>
        </div>
        <div class="cricle" data-coor="gray">
            <div class="cricle-text">
                <div class="cricle-text__title">Посмотреть результаты</div>
            </div>
        </div>
        <div class="cricle" data-coor="gray">
            <div class="cricle-text">
                <div class="cricle-text__title">Наградные материалы</div>
            </div>
        </div>
    </div>

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

@endsection