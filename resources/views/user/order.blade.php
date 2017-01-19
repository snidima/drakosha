@extends('layouts/main')

@section('content')

    <h1>Подать заявку</h1>
    <hr>
    <form method="post" action="{{route('order')}}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="org_num">Общее количество организаторов</label>
            <input type="number" class="form-control" id="org_num" name="org_num" placeholder="Общее количество организаторов">
        </div>
        <div class="form-group">
            <label for="region">Регион</label>
            <input type="text" class="form-control" id="region" placeholder="Регион" name="region">
        </div>
        <div class="form-group">
            <label for="city">Населенный пункт</label>
            <input type="text" class="form-control" id="city" placeholder="Населенный пункт" name="city">
        </div>
        <div class="form-group">
            <label for="address">Улица, номер дома, квартира</label>
            <input type="text" class="form-control" id="address" placeholder="Населенный пункт" name="address">
        </div>
        <div class="form-group">
            <label for="postcode">Почтовый индекс</label>
            <input type="text" class="form-control" id="postcode" placeholder="Почтовый индекс" name="postcode">
        </div>
        <div class="form-group">
            <label for="city">Название учебного учреждения</label>
            <input type="text" class="form-control" id="school" placeholder="Название учебного учреждения" name="school">
        </div>
        <div class="form-group">
            <label for="sert_count">Необходимое количество сертификатов ( по количеству выбранных предметов )</label>
            <input type="text" class="form-control" id="sert_count" placeholder="Необходимое количество сертификатов" name="sert_count">
        </div>
        <div class="form-group">
            <label for="learner">Класс - количество участников</label>
            <textarea class="form-control" id="learner" name="learner"></textarea>
        </div>
        <div class="form-group">
            <label for="phone">Контактный телефон</label>
            <input type="number" class="form-control" id="phone" placeholder="Контактный телефон" name="phone">
        </div>
        <div class="form-group">
            <label for="reward">Форма получения нагрдных материалов</label>
            <select name="reward" id="reward" class="form-control">
                @foreach( $rewards as $reward )
                    @if ( $loop->iteration == 1 )
                        <option selected="selected" value="{{$reward}}">{{$reward}}</option>
                    @else
                        <option value="{{$reward}}">{{$reward}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-default">Отправить заявку</button>
    </form>

@endsection