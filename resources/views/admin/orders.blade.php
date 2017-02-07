@extends('admin/layouts/main')

@section('content')

    <div class="container">

        @if( count($users) > 0 )
        <table class="table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Статус</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Email</th>
                    <th>Номер телефона</th>
                    <th>Баланс</th>
                    <th>Чек</th>
                    <th>Ответы</th>
                    <th>Просмотр</th>
                </tr>
            </thead>
            <tbody>
            @foreach( $users as $user )
                <tr @if($user->orders->first()->status) class="success" @endif>
                    <td>{{$user->id}}</td>
                    <td>
                        @if( $user->orders->first()->status )
                            Оплачен
                        @elseif( $user->orders->first()->money > 0 )
                            Оплачен не полностью
                        @else
                            Не оплачен
                        @endif

                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->surname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->orders->first()->phone}}</td>
                    <td>{{$user->orders->first()->money}} р.</td>
                    <td>@if ( $user->pay_checks->first() ) <a href="{{route('download.paychecks',['id' => $user->id ])}}">Скачать</a> @else Нет @endif </td>
                    <td>@if ( $user->answers->first() ) <a href="{{route('download.answer',['id' => $user->id ])}}">Скачать</a> @else Нет @endif </td>
                    <td>
                        <a href="{{route('order',$user->id )}}">Просмотр</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>




        @else
            <h1 style="text-align: center;">Заявок пока нет =(</h1>
        @endif

    </div>

@endsection