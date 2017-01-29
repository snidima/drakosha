@extends('layouts/main')

@section('content')
    <h1>
        Прислать ответ
        @if( count($answers)>0 )
            <br>
            Вы уже загружали файл с ответами(<a href="{{route('download.answer',['id'=>$answers->first()->id])}}">Скачать</a>)

            <br>
            Старый файл будет перезаписан на новый.
        @endif
    </h1>



    <form action="{{route('user.answer')}}" method="post" class="form_login" enctype="multipart/form-data">
        <small class="errors">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </small>
        {{ csrf_field() }}
        <div class="row">
            <label for="file" class="col-lg-4 control-label">Файл с ответами</label>
            <div class="col-lg-8">
                <input type="file" class="form-control" id="file"  name="file">
            </div>
        </div>
        <div class="text-right">
            @if( count($answers)>0 )
                <input type="submit" value="Зменить старый файл">
            @else
                <input type="submit" value="Прикрепить файл">
            @endif
        </div>
    </form>

@endsection