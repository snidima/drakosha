@extends('layouts/main')

@section('content')

        <section class="main-section">
            <div class="container">
                <header class="main-section__header">Участие в дисциплинах</header>
                <div class="school-items">
                    <a href="#" class="school-items__item">
                        <div class="school-items__image" style="background-image: url(../images/main-item-1.png)"></div>
                        <div class="school-items__text">Математика</div>
                        <div class="school-items__small">1-5 класс</div>
                        <button class="school-items__action"><i class="fa fa-rocket" aria-hidden="true"></i>Участвовать</button>
                    </a>
                    <div class="school-items__item">
                        <div class="school-items__image" style="background-image: url(../images/main-item-2.png)"></div>
                        <div class="school-items__text">Русский язык</div>
                        <div class="school-items__small">1-5 класс</div>
                        <button class="school-items__action"><i class="fa fa-rocket" aria-hidden="true"></i>Участвовать</button>
                    </div>
                    <div class="school-items__item">
                        <div class="school-items__image" style="background-image: url(../images/main-item-3.png)"></div>
                        <div class="school-items__text">Литературное чтение</div>
                        <div class="school-items__small">1-5 класс</div>
                        <button class="school-items__action"><i class="fa fa-rocket" aria-hidden="true"></i>Участвовать</button>
                    </div>
                    <div class="school-items__item">
                        <div class="school-items__image" style="background-image: url(../images/main-item-4.png)"></div>
                        <div class="school-items__text">Английский язык</div>
                        <div class="school-items__small">1-5 класс</div>
                        <button class="school-items__action"><i class="fa fa-rocket" aria-hidden="true"></i>Участвовать</button>
                    </div>
                    <div class="school-items__item">
                        <div class="school-items__image" style="background-image: url(../images/main-item-5.png)"></div>
                        <div class="school-items__text">Окружающий мир</div>
                        <div class="school-items__small">1-5 класс</div>
                        <button class="school-items__action"><i class="fa fa-rocket" aria-hidden="true"></i>Участвовать</button>
                    </div>
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
                <header class="main-section__header">Стоимость участия:</header>
                <div class="row">
                    <div class="col-md-5 section-pay_l">
                        <div class="section-pay">
                            <div class="section-pay__title">60 Р</div>
                            <div class="section-pay__desc">
                                Направляется в оргкомитет<br>
                                организаторам конкурса
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 tac">
                        <img src="/images/section-pencil.png" alt="Дракоша - стоимость участия">
                    </div>
                    <div class="col-md-5 section-pay_r">
                        <div class="section-pay">
                            <div class="section-pay__title">10 Р</div>
                            <div class="section-pay__desc">
                                Остаются в школе<br>
                                на сопутствующие<br>
                                организационные расходы
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
                                получат <b class="color2">сертификаты участников</b>,<br>
                                а наиболее отличившиеся по итогам конкурса -<br>
                                <b class="color2">дипломы I, II, III степени</b>
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
                                Наиболее активные организаторы<br>
                                (собравшие более 50 участников)<br>
                                получат <b class="color1">ценные подарки</b>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection