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

    <h1>Управление заданиями</h1>
        <hr>
        @if( count($tasks) > 0 )
            <table class="table">
                <thead>
                <tr>
                    <th>Активность</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Ссылка на задание</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $tasks as $task )
                    <tr>
                        <td>
                            @if( $task->status )
                                Да
                            @else
                                Нет
                            @endif
                        </td>
                        <td>{{$task->name}}</td>
                        <td>{{$task->desc}}</td>
                        <td><a href="{{route('download.task',$task->id)}}">Скачать</a></td>
                        <td>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#task-edit-{{$task->id}}">Редактировать</button>
                            <div class="modal fade" id="task-edit-{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Задание "{{$task->name}}", №{{$task->id}}</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{route('task-edit')}}">
                                                <input type="hidden" name="id" value="{{$task->id}}">
                                                {{csrf_field()}}
                                                <fieldset>
                                                    <div class="form-group">
                                                        <label for="name" class="col-lg-2 control-label">Название</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Название" value="{{$task->name}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="desc" class="col-lg-2 control-label">Описание</label>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" rows="5" name="desc" id="desc">{{$task->desc}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label">Активность</label>
                                                        <div class="col-lg-10 text-left">
                                                            <label class="checkbox-inline"><input type="radio" name="status" value="1" @if( $task->status ) checked @endif> Да</label>
                                                            <label class="checkbox-inline"><input type="radio" name="status" value="0" @if( !$task->status ) checked @endif> Нет</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="file" class="col-lg-2 control-label">Файл</label>
                                                        <div class="col-lg-10">
                                                            <input type="file" id="file" name="file">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-10 col-lg-offset-2">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                                            <input type="submit" class="btn btn-success" value="Сохранить">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#task-del-{{$task->id}}">Удалить</button>
                            <div class="modal fade" id="task-del-{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Удалить задание "{{$task->name}}"</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route('task-delete')}}" method="post">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{$task->id}}">
                                                <input type="submit" class="btn btn-danger" value="Удалить">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h1 style="text-align: center;">Заданий пока нет =(</h1>
        @endif
        <hr>
        <button class="btn btn-success" data-toggle="modal" data-target="#task-add">Добавить новое задание</button>
        <div class="modal fade" id="task-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Добавление нового задания</h4>
                    </div>
                    <div class="modal-footer">
                        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{route('task-add')}}">
                            {{csrf_field()}}
                            <fieldset>
                                <div class="form-group">
                                    <label for="name" class="col-lg-2 control-label">Название</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Название">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="desc" class="col-lg-2 control-label">Описание</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" rows="5" name="desc" id="desc"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="file" class="col-lg-2 control-label">Файл</label>
                                    <div class="col-lg-10">
                                        <input type="file"  id="file" name="file">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                        <input type="submit" class="btn btn-success" value="Сохранить">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection