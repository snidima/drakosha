@extends('admin/layouts/main')

@section('content')

    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Ошибка!</strong> {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Успешно!</strong> {{ session('success') }}
            </div>
        @endif
        <h3 class="text-center">Заявка от пользователя {{$order->users->name}} {{$order->users->surname}}</h3>
        <hr>
        <div class="row">

            <div class="col-xs-12">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">

                        <div class="panel panel-default">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <b>Имя:</b> {{$order->users->name}}
                                </li>
                                <li class="list-group-item">
                                    <b>Фамилия:</b> {{$order->users->surname}}
                                </li>
                                <li class="list-group-item">
                                    <b>Отчество:</b> {{$order->users->lastname}}
                                </li>
                                <li class="list-group-item">
                                    <b>Страна:</b> {{$order->users->country}}
                                </li>
                                <li class="list-group-item">
                                    <b>Номер телефона:</b> {{$order->phone}}
                                </li>
                                <li class="list-group-item">
                                    <b>Email:</b> {{$order->users->email}}
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
                                <li class="list-group-item">
                                    <b>Баланс:</b> {{$order->money}} из {{$order->sert_count*\Config::get('constants.PRICE') }}
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#order-money">
                                        Изменить
                                    </button>
                                    <div class="modal fade" id="order-money">
                                        <div class="modal-dialog" role="document">
                                            <form class="modal-content" method="post" action="{{route('order.money.update')}}">
                                                {{csrf_field()}}
                                                <input type="hidden" name="id" value="{{$order->id}}">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Изменить баланс</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" class="form-control" placeholder="Необходимое количество сертификатов" name="money" value="{{$order->money}}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                                    <input type="submit" class="btn btn-success" value="Сохранить">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <b>Чек оплаты:</b> <a href="{{route('download.paychecks',['id' =>$order->users->id ] )}}">Просмотр</a>

                                </li>
                            </ul>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <ul class="list-group">
                            <li class="list-group-item">

                            </li>


                        </ul>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">...</div>
                    <div role="tabpanel" class="tab-pane" id="settings">...</div>
                </div>
            </div>


        </div>
    </div>

@endsection