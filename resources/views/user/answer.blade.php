@extends('layouts/main')
@section('title', 'Ответы')
@section('content')
@include('user/parts/user-nav')

    <div class="container">



        @if( count($answers)>0 )
            <h2 class="pay-h2">
                Ранее вы уже загружали ответы - <a href="{{route('download.answer', ['id' => \Illuminate\Support\Facades\Auth::user()->id])}}">скачать</a><br>
                <small>
                    Повторная заграузка заменит предыдущий файл ответов
                </small>
            </h2>
        @else
            <h2 class="pay-h2">Загрузить ответы: </h2>
        @endif

            <form method="post" action="{{route('user.answer')}}" style="margin-top: 20px"  class="form form-small" v-bind:class="{ pending: pending}" id="upload-answer"  v-on:submit.prevent="send"  enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form__row">
                    <label for="file">Прикрепите ответы ( zip, rar, 7z )</label>
                    <input type="file" name="file" id="file"  v-on:change="fileChange">
                    <label for="file" class="file-label" v-if="file" v-bind:class="{ 'active': file, error: error }" ><i class="fa fa-file" aria-hidden="true"></i>@{{ file }}</label>
                    <label for="file" class="file-label" v-else  v-bind:class="{ error: error }">Выбирите файл</label>
                    <p class="form__error" v-if="error">@{{error}}</p>
                </div>
                <div class="form__row">
                    <button class="btn2 btn2-color1" style="display: block;width: 100%"><i class="fa fa-upload" aria-hidden="true"></i>Загрузить ответы</button>
                </div>
                <div class="form__pending" v-show="pending" style="display: none;">
                    <div class="form__pending-wrapper">
                        <div class="sk-circle">
                            <div class="sk-circle1 sk-child"></div>
                            <div class="sk-circle2 sk-child"></div>
                            <div class="sk-circle3 sk-child"></div>
                            <div class="sk-circle4 sk-child"></div>
                            <div class="sk-circle5 sk-child"></div>
                            <div class="sk-circle6 sk-child"></div>
                            <div class="sk-circle7 sk-child"></div>
                            <div class="sk-circle8 sk-child"></div>
                            <div class="sk-circle9 sk-child"></div>
                            <div class="sk-circle10 sk-child"></div>
                            <div class="sk-circle11 sk-child"></div>
                            <div class="sk-circle12 sk-child"></div>
                        </div>
                    </div>
                </div>
            </form>




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