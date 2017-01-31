@extends('layouts/main')

@section('content')



    <h1>Подать заявку</h1>

    <form method="post" action="{{route('user.order')}}" class="form_login form_login_reg ">
        {{ csrf_field() }}

        @if (count($errors) > 0)
        <small class="text-color-red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </small>
        @endif

        <div class="form-group text-left">
            <label for="org_num">Общее количество организаторов</label>
            <input type="number" class="form-control" id="org_num" name="org_num" placeholder="Общее количество организаторов" value="{{ old('org_num') ? old('org_num') : $order['org_num']}}">
        </div>
        <div class="form-group">
            <label for="region">Регион</label>
            <input type="text" class="form-control" id="region" placeholder="Регион" name="region" value="{{ old('region') ? old('region') : $order['region']}}">
        </div>
        <div class="form-group">
            <label for="city">Населенный пункт</label>
            <input type="text" class="form-control" id="city" placeholder="Населенный пункт" name="city" value="{{ old('city') ? old('city') : $order['city']}}">
        </div>
        <div class="form-group">
            <label for="address">Улица, номер дома, квартира</label>
            <input type="text" class="form-control" id="address" placeholder="Населенный пункт" name="address" value="{{ old('address') ? old('address') : $order['address']}}">
        </div>
        <div class="form-group">
            <label for="postcode">Почтовый индекс</label>
            <input type="text" class="form-control" id="postcode" placeholder="Почтовый индекс" name="postcode" value="{{ old('postcode') ? old('postcode') : $order['postcode']}}">
        </div>
        <div class="form-group">
            <label for="city">Название учебного учреждения</label>
            <input type="text" class="form-control" id="school" placeholder="Название учебного учреждения" name="school" value="{{ old('school') ? old('school') : $order['school']}}">
        </div>
        <div class="form-group">
            <label for="sert_count">Необходимое количество сертификатов ( по количеству выбранных предметов )</label>
            <input type="text" class="form-control" id="sert_count" placeholder="Необходимое количество сертификатов" name="sert_count" value="{{ old('sert_count') ? old('sert_count') : $order['sert_count']}}">
        </div>
        <div class="form-group">
            <label for="learner">Организаторы - участники:</label>
            <textarea class="form-control" id="learner" name="learner">{{ old('learner') ? old('learner') : $order['learner']}}</textarea>
        </div>
        <div class="form-group">
            <label for="teacher_learner">Предмет - класс - участники:</label>
            <textarea class="form-control" id="teacher_learner" name="teacher_learner">{{ old('teacher_learner') ? old('teacher_learner') : $order['teacher_learner']}}</textarea>
        </div>
        <div class="form-group">
            <label for="phone">Контактный телефон</label>
            <input type="number" class="form-control" id="phone" placeholder="Контактный телефон" name="phone" value="{{ old('phone') ? old('phone') : $order['phone']}}">
        </div>
        <div class="form-group">
            <label for="reward">Форма получения нагрдных материалов</label>
            <select name="reward" id="reward" class="form-control">
                @foreach( $rewards as $reward )
                    @if ( (( $reward == $order['reward'] ) || ( $reward == old('reward') )) || ( $loop->iteration == 1 ) )
                        <option selected="selected" value="{{$reward}}">{{$reward}}</option>
                    @else
                        <option value="{{$reward}}">{{$reward}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <input type="submit" value="Отправить заявку">
    </form>



@endsection