@extends('admin/layouts/main')

@section('content')
    <div class="container">

        @if( count($answers) > 0 )
            <table class="table">
                <thead>
                <tr>
                    <th>№</th>
                    <th>ФИО</th>
                    <th>Email</th>
                    <th>Скачать файл</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $answers as $answer )
                    <tr>
                        <td>{{$answer->id}}</td>
                        <td>{{$answer->users->surname}} {{$answer->users->name}} {{$answer->users->lastname}}</td>
                        <td>{{$answer->users->email}}</td>
                        <td><a href="{{route('download.answer',['id'=>$answer->id])}}">Скачать</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else
            <h1 style="text-align: center;">Заявок пока нет =(</h1>
        @endif

    </div>
@endsection