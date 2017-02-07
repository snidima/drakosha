@extends('layouts/main')

@section('content')
@include('user/parts/user-nav')

    <div class="container">



        @if( count($answers)>0 )
            <h2 class="pay-h2">
                Ранее вы уже загружали ответы.<br>
                <small id="asnwer-upload-again" class="cursor">
                    Загрузить еще раз
                </small>
            </h2>
                <form method="post" action="#" style="margin-top: 20px; display: none;" id="upload-answer"  class="form form-small"  {{route('user.answer')}} enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form__row">
                        <label for="file">Прикрепите ответы ( doc, docx )</label>
                        <input type="file" name="file" id="file" required v-on:change="fileChange">
                        <label for="file" class="file-label" v-if="file" v-bind:class="{ 'active': file }"><i class="fa fa-file" aria-hidden="true"></i>@{{ file }}</label>
                        <label for="file" class="file-label" v-else >Выбирите файл</label>
                    </div>
                    <div class="form__row">
                        <button class="btn2 btn2-color1" style="display: block;width: 100%"><i class="fa fa-upload" aria-hidden="true"></i>Загрузить ответы</button>
                    </div>
                </form>
            </h2>
        @else

            <h2 class="pay-h2">Загрузить ответы: </h2>

            <form method="post" action="#" style="margin-top: 20px"  class="form form-small" id="upload-answer" {{route('user.answer')}} enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form__row">
                    <label for="file">Прикрепите ответы ( doc, docx )</label>
                    <input type="file" name="file" id="file" required v-on:change="fileChange">
                    <label for="file" class="file-label" v-if="file" v-bind:class="{ 'active': file }"><i class="fa fa-file" aria-hidden="true"></i>@{{ file }}</label>
                    <label for="file" class="file-label" v-else >Выбирите файл</label>
                </div>

                <div class="form__row">
                    <button class="btn2 btn2-color1" style="display: block;width: 100%"><i class="fa fa-upload" aria-hidden="true"></i>Загрузить ответы</button>
                </div>
            </form>

        @endif


    </div>




    {{--<h1>--}}
        {{--Прислать ответ--}}
        {{--@if( count($answers)>0 )--}}
            {{--<br>--}}
            {{--Вы уже загружали файл с ответами(<a href="{{route('download.answer',['id'=>$answers->users->id])}}">Скачать</a>)--}}

            {{--<br>--}}
            {{--Старый файл будет перезаписан на новый.--}}
        {{--@endif--}}
    {{--</h1>--}}



    {{--<form action="{{route('user.answer')}}" method="post" class="form_login" enctype="multipart/form-data">--}}
        {{--<small class="errors">--}}
            {{--@if (count($errors) > 0)--}}
                {{--<div class="alert alert-danger">--}}
                    {{--<ul>--}}
                        {{--@foreach ($errors->all() as $error)--}}
                            {{--<li>{{ $error }}</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--@endif--}}
        {{--</small>--}}
        {{--{{ csrf_field() }}--}}
        {{--<div class="row">--}}
            {{--<label for="file" class="col-lg-4 control-label">Файл с ответами</label>--}}
            {{--<div class="col-lg-8">--}}
                {{--<input type="file" class="form-control" id="file"  name="file">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="text-right">--}}
            {{--@if( count($answers)>0 )--}}
                {{--<input type="submit" value="Зменить старый файл">--}}
            {{--@else--}}
                {{--<input type="submit" value="Прикрепить файл">--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</form>--}}

@endsection