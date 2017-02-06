@extends('layouts/main')

@section('content')

    <div class="container">

        @include('user/parts/user-nav')


        <form action="{{route('user.order')}}" class="form form-large" v-bind:class="{ pending: pending}" id="order" method="post" v-on:submit.prevent="send">
            <div class="row">
                <div class="col-md-6">
                    <div class="form__row">
                        <label for="region">Регион</label>
                        <input type="text" name="region" required id="region" v-model="region.value" placeholder="Регион" v-bind:class="{ error: region.error }">
                        <p class="form__error" v-if="region.error">@{{region.error}}</p>
                    </div>
                    <div class="form__row">
                        <label for="city">Населенный пункт</label>
                        <input type="text" name="city" required id="city" v-model="city.value" v-bind:class="{ error: city.error }" placeholder="Населенный пункт">
                        <p class="form__error" v-if="city.error">@{{city.error}}</p>
                    </div>
                    <div class="form__row">
                        <label for="address">Улица, номер дома, квартира</label>
                        <input type="text" name="address" required id="address" v-model="address.value" v-bind:class="{ error: address.error }" placeholder="Улица, номер дома, квартира">
                        <p class="form__error" v-if="city.error">@{{city.error}}</p>
                    </div>
                    <div class="form__row">
                        <label for="postcode">Почтовый индекс</label>
                        <input type="number" name="postcode" required id="postcode" v-model="postcode.value" v-bind:class="{ error: postcode.error }" placeholder="Почтовый индекс">
                        <p class="form__error" v-if="postcode.error">@{{postcode.error}}</p>
                    </div>
                    <div class="form__row">
                        <label for="school">Название учебного учреждения</label>
                        <input type="text" name="school" required id="school" v-model="school.value" v-bind:class="{ error: school.error }" placeholder="Название учебного учреждения">
                        <p class="form__error" v-if="school.error">@{{school.error}}</p>
                    </div>
                    <div class="form__row">
                        <label for="phone">Контактный телефон</label>
                        <input type="text" name="phone" required id="phone" v-model="phone.value" placeholder="Контактный телефон" v-bind:class="{ error: phone.error }">
                        <p class="form__error" v-if="phone.error">@{{phone.error}}</p>
                    </div>
                    <div class="form__row">
                        <label for="org_num">Общее количество организаторов</label>
                        <input type="number" name="org_num" id="org_num" v-model="org_num.value" placeholder="Общее количество организаторов" v-bind:class="{ error: org_num.error }">
                        <p class="form__error" v-if="org_num.error">@{{org_num.error}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form__row">
                        <label for="sert_count">Необходимое количество сертификатов</label>
                        <input type="number" name="sert_count" required id="sert_count" v-model="sert_count.value" placeholder="Необходимое количество сертификатов" v-bind:class="{ error: sert_count.error }">
                        <p class="form__error" v-if="sert_count.error">@{{sert_count.error}}</p>
                    </div>
                    <div class="form__row">
                        <label for="learner">Организаторы - участники:</label>
                        <textarea name="learner" id="learner" v-model="learner.value" v-bind:class="{ error: learner.error }" placeholder="Организаторы - участники:"></textarea>
                        <p class="form__error" v-if="learner.error">@{{learner.error}}</p>
                    </div>
                    <div class="form__row">
                        <label for="teacher_learner">Предмет - класс - участники:</label>
                        <textarea name="teacher_learner" v-model="teacher_learner.value" v-bind:class="{ error: teacher_learner.error }" id="teacher_learner" placeholder="Организаторы - участники:"></textarea>
                        <p class="form__error" v-if="teacher_learner.error">@{{teacher_learner.error}}</p>
                    </div>
                    <div class="form__row">
                        <label for="reward">Форма получения нагрдных материалов</label>
                        <select name="reward" id="reward" v-model="reward.value">
                            <option v-for="reward in defaultReward" v-bind:value="reward" >@{{ reward }}</option>
                        </select>

                    </div>

                </div>
            </div>

            <div class="form__action">
                <button class="btn2 btn2-color1" id="btn-send"><i class="fa fa-paper-plane" aria-hidden="true"></i>Отправить</button>
            </div>
            <div class="form__pending" v-if="pending">
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

    {{--<h1>Подать заявку</h1>--}}

    {{--<form method="post" action="{{route('user.order')}}" class="form_login form_login_reg ">--}}
        {{--{{ csrf_field() }}--}}

        {{--@if (count($errors) > 0)--}}
        {{--<small class="text-color-red">--}}
            {{--<ul>--}}
                {{--@foreach ($errors->all() as $error)--}}
                    {{--<li>{{ $error }}</li>--}}
                {{--@endforeach--}}
            {{--</ul>--}}
        {{--</small>--}}
        {{--@endif--}}

        {{--<div class="form-group text-left">--}}
            {{--<label for="org_num">Общее количество организаторов</label>--}}
            {{--<input type="number" class="form-control" id="org_num" name="org_num" placeholder="Общее количество организаторов" value="{{ old('org_num') ? old('org_num') : $order['org_num']}}">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="region">Регион</label>--}}
            {{--<input type="text" class="form-control" id="region" placeholder="Регион" name="region" value="{{ old('region') ? old('region') : $order['region']}}">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="city">Населенный пункт</label>--}}
            {{--<input type="text" class="form-control" id="city" placeholder="Населенный пункт" name="city" value="{{ old('city') ? old('city') : $order['city']}}">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="address">Улица, номер дома, квартира</label>--}}
            {{--<input type="text" class="form-control" id="address" placeholder="Населенный пункт" name="address" value="{{ old('address') ? old('address') : $order['address']}}">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="postcode">Почтовый индекс</label>--}}
            {{--<input type="text" class="form-control" id="postcode" placeholder="Почтовый индекс" name="postcode" value="{{ old('postcode') ? old('postcode') : $order['postcode']}}">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="city">Название учебного учреждения</label>--}}
            {{--<input type="text" class="form-control" id="school" placeholder="Название учебного учреждения" name="school" value="{{ old('school') ? old('school') : $order['school']}}">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="sert_count">Необходимое количество сертификатов ( по количеству выбранных предметов )</label>--}}
            {{--<input type="text" class="form-control" id="sert_count" placeholder="Необходимое количество сертификатов" name="sert_count" value="{{ old('sert_count') ? old('sert_count') : $order['sert_count']}}">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="learner">Организаторы - участники:</label>--}}
            {{--<textarea class="form-control" id="learner" name="learner">{{ old('learner') ? old('learner') : $order['learner']}}</textarea>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="teacher_learner">Предмет - класс - участники:</label>--}}
            {{--<textarea class="form-control" id="teacher_learner" name="teacher_learner">{{ old('teacher_learner') ? old('teacher_learner') : $order['teacher_learner']}}</textarea>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="phone">Контактный телефон</label>--}}
            {{--<input type="number" class="form-control" id="phone" placeholder="Контактный телефон" name="phone" value="{{ old('phone') ? old('phone') : $order['phone']}}">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="reward">Форма получения нагрдных материалов</label>--}}
            {{--<select name="reward" id="reward" class="form-control">--}}
                {{--@foreach( $rewards as $reward )--}}
                    {{--@if ( (( $reward == $order['reward'] ) || ( $reward == old('reward') )) || ( $loop->iteration == 1 ) )--}}
                        {{--<option selected="selected" value="{{$reward}}">{{$reward}}</option>--}}
                    {{--@else--}}
                        {{--<option value="{{$reward}}">{{$reward}}</option>--}}
                    {{--@endif--}}
                {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}
        {{--<input type="submit" value="Отправить заявку">--}}
    {{--</form>--}}



@endsection