@extends('admin/layouts/main')

@section('content')

    <div class="container">
        <h3 class="text-center">Заявка от пользователя {{$order->users->first()->name}} {{$order->users->first()->surname}}</h3>
        <hr>
        <div class="row">
            <div class="col-xs-3">
                <ul class="nav nav-pills nav-stacked" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Информация</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Счет</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Ответы</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Наградные материалы</a></li>
                </ul>
            </div>
            <div class="col-xs-9">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">

                        <div class="panel panel-default">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <b>Имя:</b> {{$order->users->first()->name}}
                                </li>
                                <li class="list-group-item">
                                    <b>Фамилия:</b> {{$order->users->first()->surname}}
                                </li>
                                <li class="list-group-item">
                                    <b>Отчество:</b> {{$order->users->first()->lastname}}
                                </li>
                                <li class="list-group-item">
                                    <b>Отчество:</b> {{$order->users->first()->lastname}}
                                </li>
                                <li class="list-group-item">
                                    <b>Номер телефона:</b> {{$order->phone}}
                                </li>
                                <li class="list-group-item">
                                    <b>Email:</b> {{$order->users->first()->email}}
                                </li>
                                <li class="list-group-item">
                                    <b>Регион:</b> {{$order->region}}
                                </li>
                                <li class="list-group-item">
                                    <b>Город:</b> {{$order->city}}
                                </li>
                                <li class="list-group-item">
                                    <b>Адрес:</b> {{$order->address}}
                                </li>
                                <li class="list-group-item">
                                    <b>Почтовый индекс:</b> {{$order->postcode}}
                                </li>
                                <li class="list-group-item">
                                    <b>Название учебного учреждения:</b> {{$order->school}}
                                </li>
                                <li class="list-group-item">
                                    <b>Общее количество организаторов:</b> {{$order->org_num}}
                                </li>
                                <li class="list-group-item">
                                    <b>Необходимое количество сертификатов:</b> {{$order->sert_count}}
                                </li>
                                <li class="list-group-item">
                                    <b>Организаторы - участники:</b><br>
                                    <pre>{!! $order->learner !!}</pre>
                                </li>
                                <li class="list-group-item">
                                    <b>Предмет - класс - участники:</b><br>
                                    <pre>{!! $order->teacher_learner !!}</pre>
                                </li>
                                <li class="list-group-item">
                                    <b>Форма получения нагрдных материалов:</b> {{$order->reward}}
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <b>Баланс:</b> {{$order->money}}
                                <div class="modal fade" id="order-money" tabindex="-1" role="dialog" aria-labelledby="OrderMoney">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Изменить баланс</h4>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" class="form-control" id="sert_count" placeholder="Необходимое количество сертификатов" name="sert_count" value="{{$order->money}}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                                <button type="button" class="btn btn-success">Сохранть</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <b>Чек оплаты:</b> <a href="#">Просмотр</a>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#order-money">
                            Изменить баланс
                        </button>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">...</div>
                    <div role="tabpanel" class="tab-pane" id="settings">...</div>
                </div>
            </div>


        </div>
    </div>

@endsection