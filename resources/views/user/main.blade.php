@extends('layouts/main')

@section('content')

    <h3>{{Auth::user()->name}}, добро пожаловать в Ваш личный раздел на нашем сайте!<br><small><a href="{{route('profile')}}">Изменить мои настройки</a></small></h3>

    <p>Для того чтобы успешно завершить участие в конкурсе, Вам нужно последовательно выполнить следующие шаги:</p>
    <ol>
        <li>
            <a href="{{route('user.order')}}">
                @if( $params['newOrderAvailable'] )
                    Подать заявку
                @else
                    Редактировать заявку
                @endif
            </a>
        </li>
        <li>Произвести оплату и прикрепить чек</li>
        <li>ОТправить ответы</li>
        <li>ПОсмотреть результаты</li>
        <li>Получить наградные материалы</li>
    </ol>

@endsection