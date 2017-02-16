@extends('layouts/main')

@section('content')



    @include('user/parts/user-nav')

    <div class="container">


        <form action="{{route('user.order')}}" class="form form-large" v-bind:class="{ pending: pending}" id="order" method="post" v-on:submit.prevent="send">
            <a href="{{route('for-teachers')}}" class="order-warning2">
                ДЕНЕЖНОЕ ВОЗНАГРАЖДЕНИЕ ДЛЯ ОРГАНИЗАТОРОВ
            </a>
            <h2 class="pay-h2" style="margin-bottom: 0;">
                @if( !\App\Order::getForCurrentUser() )
                    <div class="user-nav__title">Заполните данные для заявки</div>
                @else
                    <div class="user-nav__title">Отредактируйте данные заявки<br><small>( редактирование заявки возможно до {{$days}} )</small></div>
                    <div id="order-edit-warning" style="display: none">
                        {{\Illuminate\Support\Facades\Auth::user()->name}}, если вы хотите добавить новых участников - отредактируйте уже созданную заявку указав общее количество сертификатов
                    </div>
                @endif
            </h2>
            <div class="order-warning">
                <span>Внимание!</span> Если у Вас возникли вопросы по заполнению полей,<br>просто нажмите на синий значок справа от поля для получения подсказки!
            </div>

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
                </div>
                <div class="col-md-6">
                    <div class="form__row">
                        <label for="org_num">Общее количество организаторов</label>
                        <input type="number" name="org_num" id="org_num" v-model="org_num.value" placeholder="Общее количество организаторов" v-bind:class="{ error: org_num.error }">
                        <p class="form__error" v-if="org_num.error">@{{org_num.error}}</p>
                    </div>

                    <div class="form__row">
                        <label for="sert_count">Общее количество сертификатов<br>(по количеству выбранных предметов)</label>
                        <input type="number" name="sert_count" required id="sert_count" v-model="sert_count.value" placeholder="Необходимое количество сертификатов" v-bind:class="{ error: sert_count.error }">
                        <p class="form__error" v-if="sert_count.error">@{{sert_count.error}}</p>
                    </div>
                    {{--<div class="form__row">--}}
                        {{--<label for="learner">Организаторы - количество участников <i class="fa cursor fa-info-circle color2" id="orgs" aria-hidden="true"></i> :</label>--}}
                        {{--<textarea name="learner" id="learner" v-model="learner.value" v-bind:class="{ error: learner.error }"--}}
                                  {{--placeholder="Например:&#13;&#10;Иванову Марину Петровну - 4,&#13;&#10;Соколова Дмитрия Валерьевича - 15--}}
                        {{--"></textarea>--}}
                        {{--<p class="form__error" v-if="learner.error">@{{learner.error}}</p>--}}
                    {{--</div>--}}
                    <div class="form__row">
                        <label for="teacher_learner">Предмет - класс - количество участников <i class="fa cursor fa-info-circle color2" id="orgs2" aria-hidden="true"></i> :</label>
                        <textarea name="teacher_learner" v-model="teacher_learner.value" v-bind:class="{ error: teacher_learner.error }" id="teacher_learner"
                                  placeholder="Например:&#13;&#10;русский язык-2класс-10 участников
                        "></textarea>
                        <p class="form__error" v-if="teacher_learner.error">@{{teacher_learner.error}}</p>
                    </div>
                    <div class="form__row">
                        <label for="reward">Форма получения наградных материалов <i class="fa cursor fa-info-circle color2" id="sert" aria-hidden="true"></i> :</label>
                        <select name="reward" id="reward" v-model="reward.value">
                            <option v-for="reward in defaultRewardD" v-bind:value="reward.value" :disabled="reward.avail">@{{ reward.value }}</option>
                        </select>

                    </div>

                </div>
            </div>

            <div class="form__action">
                <button class="btn2 btn2-color1" id="btn-send"><i class="fa fa-paper-plane" aria-hidden="true"></i>Отправить</button>
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

@endsection