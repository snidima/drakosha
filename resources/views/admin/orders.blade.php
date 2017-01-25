@extends('admin/layouts/main')

@section('content')

    <div class="container">

        @if( count($orders) > 0 )
        <table class="table">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Email</th>
                    <th>Номер телефона</th>
                    <th>Статус заявки</th>
                    <th>Просмотр</th>
                </tr>
            </thead>
            <tbody>
            @foreach( $orders as $order )
                <tr>
                    <td>{{$order->users->first()->name}}</td>
                    <td>{{$order->users->first()->surname}}</td>
                    <td>{{$order->users->first()->email}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->money}}</td>
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