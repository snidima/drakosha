@extends('admin/layouts/main')

@section('content')

    <div class="container">

        <table class="table">
            <caption>sege</caption>
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Email</th>
                    <th>Номер телефона</th>
                    <th>Статус заявки</th>
                    <th>Просмотр/Редактирование</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
            @foreach( $orders as $order )
                <tr>
                    <td>{{$order->users->first()->name}}</td>
                    <td>{{$order->users->first()->surname}}</td>
                    <td>{{$order->users->first()->email}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->status}}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#order-{{$order->id}}">
                            Просмотр
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#order-delete-{{$order->id}}">
                            Удалить
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


        @foreach( $orders as $order )
        <div class="modal fade" id="order-{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="Orders">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Заявка №{{$order->id}}</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-success">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="order-delete-{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="Ordersdelete">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Удалить заявку №{{$order->id}}</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-danger">Удалить</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

@endsection