@extends('layouts/main')

@section('content')

    <h1>
        Оплата<br>
        <small style="font-size: 16px;">Текущий баланс: {{$money}} руб.</small><br>
        <small style="font-size: 16px;">Заявлено сертификатов: {{$sert}} </small>
    </h1>


    <form action="{{route('user.pay')}}" method="post" class="form_login">
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
            <label for="money" class="col-lg-3 control-label">Сумма, руб:</label>
            <div class="col-lg-9">
                <input type="number" class="form-control" id="money" placeholder="Сумма" name="money" value="{{$summ}}">
            </div>
        </div>
        <div class="text-right">
            <input type="submit" value="Оплатить">
        </div>
    </form>
    <br><br>
    <form action="{{route('user.paycheck')}}" method="post" class="form_login" enctype="multipart/form-data">
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
            <label for="file" class="col-lg-4 control-label">Прикрепить чек</label>
            <div class="col-lg-8">
                <input type="file" class="form-control" id="file"  name="file">
            </div>
        </div>

        <div class="text-right">
            @if( 1>0 )
                <input type="submit" value="Прикрепить чек">
            @else
                <input type="submit" value="Прикрепить чек">
            @endif
        </div>
    </form>

@endsection