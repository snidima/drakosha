@extends('admin/layouts/main')

@section('content')

    <div class="container">

        @if( count($orders) > 0 )
        <table class="table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Email</th>
                    <th>Номер телефона</th>
                    <th>Статус</th>
                    <th>Баланс</th>
                    <th>Просмотр</th>
                </tr>
            </thead>
            <tbody>
            @foreach( $orders as $order )
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->users->name}}</td>
                    <td>{{$order->users->surname}}</td>
                    <td>{{$order->users->email}}</td>
                    <td>{{$order->phone}}</td>
                    <td>
                        @if( $order->money >= ($order->sert_count * 60) )
                            Оплачен
                        @elseif( $order->money > 0 )
                            Оплачен не полностью
                        @else
                            Не оплачен
                        @endif

                    </td>
                    <td>{{$order->money}} р.</td>
                    <td>
                        <a href="{{route('order',$order->id )}}">Просмотр</a>
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