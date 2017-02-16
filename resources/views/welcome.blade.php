@extends('layouts/main')

@section('title', 'Конкурс для младших классов')



@section('content')

<div class="slider">
    <div class="slider-texts__effect"></div>
    <div class="slider-texts">
        <div class="slider-texts__big-text"><span class="color1">У</span>мный <span class="color2">Д</span>ракоша</div>
        <div class="slider-texts__under_big-text">Международный конкурс для младших школьников</div>
        <div class="slider-texts__desc">
            Оргкомитет конкурса «Умный Дракоша»<br>
            приглашает принять участие в конкурсе<br>
            по различным дисциплинам.
        </div>
        <div class="slider-texts__action">
            <a href="{{route('about')}}" class="slider-texts__btn"><i class="fa fa-info" aria-hidden="true"></i>Подробнее..</a>
        </div>
    </div>
    <div class="slider-texts__banners">
        <a href="https://www.rusfond.ru/" target="_blank"><img src="/images/rusfond.jpg" alt=""></a>
    </div>
</div>

<section class="main-section">
    <div class="container">
        <header class="main-section__header">Участие в дисциплинах</header>
        <div class="school-items">
            <a href="{{route('register')}}" class="school-items__item">
                <div class="school-items__image" style="background-image: url(../images/main-item-1.jpg)"></div>
                <div class="school-items__text">Математика</div>
                <div class="school-items__small">1-5 класс</div>
                <button class="school-items__action"><i class="fa fa-rocket" aria-hidden="true"></i>Участвовать</button>
            </a>
            <a href="{{route('register')}}" class="school-items__item">
                <div class="school-items__image" style="background-image: url(../images/main-item-2.jpg)"></div>
                <div class="school-items__text">Русский язык</div>
                <div class="school-items__small">1-5 класс</div>
                <button class="school-items__action"><i class="fa fa-rocket" aria-hidden="true"></i>Участвовать</button>
            </a>
            <a href="{{route('register')}}" class="school-items__item">
                <div class="school-items__image" style="background-image: url(../images/main-item-3.jpg)"></div>
                <div class="school-items__text">Литературное чтение</div>
                <div class="school-items__small">1-5 класс</div>
                <button class="school-items__action"><i class="fa fa-rocket" aria-hidden="true"></i>Участвовать</button>
            </a>
            <a href="{{route('register')}}" class="school-items__item">
                <div class="school-items__image" style="background-image: url(../images/main-item-4.jpg)"></div>
                <div class="school-items__text">Английский язык</div>
                <div class="school-items__small">1-5 класс</div>
                <button class="school-items__action"><i class="fa fa-rocket" aria-hidden="true"></i>Участвовать</button>
            </a>
            <a href="{{route('register')}}" class="school-items__item">
                <div class="school-items__image" style="background-image: url(../images/main-item-5.jpg)"></div>
                <div class="school-items__text">Окружающий мир</div>
                <div class="school-items__small">1-5 класс</div>
                <button class="school-items__action"><i class="fa fa-rocket" aria-hidden="true"></i>Участвовать</button>
            </a>
        </div>
    </div>
</section>

<section class="main-section main-section-bg main-section_2" style="background-image: url(../images/section-bg-1.jpg)">
    <div class="container">
        <p class="main-section-bg_text main-section-bg_text-2">
            К участию в конкурсе допускаются (без предварительного отбора)<br>
            учащиеся с 1 по 5 классы,<br>
            оплатившиеся организационный взнос
        </p>
    </div>
</section>

<section class="main-section">
    <div class="container">
        <header class="main-section__header">Сроки выполнения конкурса:</header>
        <div class="row">
            <div class="col-md-4 tac">
                <div class="section-times section-times_1">
                    <div class="section-times__icon">
                        <img src="/images/main-icon-1.png" alt="Старт конкурса Умный Дракоша">
                    </div>
                    <div class="section-times__title">Старт конкурса</div>
                    <div class="section-times__devide"></div>
                    <div class="section-times__desc">
                        Задания и бланки ответов<br> будут размещены на сайте<br> в личных кабинетах<br> участников до <b>17.01.17</b>
                    </div>
                </div>
            </div>
            <div class="col-md-4 tac">
                <div class="section-times section-times_2">
                    <div class="section-times__icon">
                        <img src="/images/main-icon-2.png" alt="Окончание конкурса Умный Дракоша">
                    </div>
                    <div class="section-times__title">Окончание конкурса</div>
                    <div class="section-times__devide"></div>
                    <div class="section-times__desc">
                        Провести конкурс <br>и отправить материалы работ необходимо
                        до <b>01.02.17</b>
                    </div>
                </div>
            </div>
            <div class="col-md-4 tac">
                <div class="section-times section-times_3">
                    <div class="section-times__icon">
                        <img src="/images/main-icon-3.png" alt="Умный дракоша. Выдача сертификатов">
                    </div>
                    <div class="section-times__title">Выдача сертификатов</div>
                    <div class="section-times__devide"></div>
                    <div class="section-times__desc">
                        Наградные материалы
                        будут отправлены
                        до <b>31.03.17</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-section main-section__pay">
    <div class="container">
        <header class="main-section__header">Стоимость за одного участника<br>в одной предметной дисциплине - <span>80 руб</span></header>
        <div class="row" style="padding-top: 30px;">
            <div class="col-md-5 section-pay_l">
                <div class="section-pay">
                    <div class="section-pay__title">{{\Config::get('constants.PRICE')}} Р</div>
                    <div class="section-pay__desc">
                        Направляется в оргкомитет<br>
                        организаторам конкурса
                    </div>
                </div>
            </div>
            <div class="col-md-2 tac" >
                <img src="/images/section-pencil.png" alt="Дракоша - стоимость участия">
            </div>
            <div class="col-md-5 section-pay_r">
                <div class="section-pay">
                    <div class="section-pay__title">10 Р</div>
                    <div class="section-pay__desc">
                        Остаются<br>
                        на сопутствующие расходы
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-section">
    <div class="container">
        <header class="main-section__header">Награждения:</header>
        <div class="row">
            <div class="col-md-6 tac">
                <div class="section-award">
                    <div class="section-award__title">Участники</div>
                    <div class="section-award__devider"></div>
                    <div class="section-award__desc">
                        Все участники без исключения<br>
                        получат <b class="color1">сертификаты участников</b>,<br>
                        а наиболее отличившиеся по итогам конкурса -<br>
                        <b class="color1">дипломы I, II, III степени</b>
                    </div>
                </div>
            </div>
            <div class="col-md-6 tac">
                <div class="section-award">
                    <div class="section-award__title">Учителя</div>
                    <div class="section-award__devider"></div>
                    <div class="section-award__desc">
                        Всем учителям, задействованным<br>
                        в подготовке и проведении конкурса в школах,<br>
                        будут выданы <b class="color1">благодарственные письма</b>.<br>
                        Наиболее активные организаторы<br>( собравшие от 50 работ, один ученик может поучаствовать во всех дисциплинах  )
                        получат <b class="color1">денежное вознаграждение</b>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection