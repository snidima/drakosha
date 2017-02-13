@extends('admin/layouts/main')

@section('content')

    <div class="container">
        @if( count($feedbacks) > 0 )
        <table class="table">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Тема</th>
                    <th>Сообщение</th>
                </tr>
            </thead>
            <tbody>
            @foreach( $feedbacks as $feedback )
                <tr>
                    <td>{{$feedback->name}}</td>
                    <td>{{$feedback->email}}</td>
                    <td>{{$feedback->subject}}</td>
                    <td>{{$feedback->text}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <h1>Данных пока нет</h1>
        @endif
    </div>

@endsection