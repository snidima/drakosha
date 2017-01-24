@extends('layouts/main')

@section('content')

    <div class="text-center main-block">
        <div class="text-size-1 condensed text-color-black"><b>УВАЖАЕМЫЕ УЧИТЕЛЯ И ШКОЛЬНЫЕ ОРГАНИЗАТОРЫ!</b></div>
        <p class="text-color-gray">
            Оргкомитет конкурса <b class="text-color-green">«Умный Дракоша»</b> приглашает принять участие<br>
            в конкурсе по различным дисциплинам.
        </p>
    </div>

    <div class="text-center main-block">
        <div class="text-size-3 condensed text-color-black"><b><u>ДЛЯ УЧАСТИЯ ВЫБЕРИТЕ ШКОЛЬНУЮ ДИСЦИПЛИНУ:</u></b></div>
        <div class="circles">
            <div class="cricle" data-coor="red">
                <div class="cricle-text">
                    <div class="cricle-text__title">Математика</div>
                    <div class="cricle-text__desc">1-5 класс</div>
                </div>
            </div>
            <div class="cricle" data-coor="green">
                <div class="cricle-text">
                    <div class="cricle-text__title">Русский язык</div>
                    <div class="cricle-text__desc">1-5 класс</div>
                </div>
            </div>
            <div class="cricle" data-coor="blue">
                <div class="cricle-text">
                    <div class="cricle-text__title">Литературное<br>чтение</div>
                    <div class="cricle-text__desc">1-5 класс</div>
                </div>
            </div>
            <div class="cricle" data-coor="magenta">
                <div class="cricle-text">
                    <div class="cricle-text__title">Английский<br>язык</div>
                    <div class="cricle-text__desc">1-5 класс</div>
                </div>
            </div>
            <div class="cricle" data-coor="orange">
                <div class="cricle-text">
                    <div class="cricle-text__title">Окружающий мир</div>
                    <div class="cricle-text__desc">1-5 класс</div>
                </div>
            </div>
        </div>
        <p><i>Прием заявок осуществляется с <span class="text-color-red">10.01.2017 по 17.01.2017</span> включительно</i></p>
    </div>

    <div class="main-block">
        <div class="main-block__title">
            <img src="/images/icons/icon-13.png" alt="Стоимость участия">СРОКИ ПРОВЕДЕНИЯ КОНКРУСА:
        </div>
        <ul class="main-time-block">
            <li>
                Задания и Бланки ответов будут
                размещены на сайтев
                <a href="#">личных кабинетах</a>
                участников <b class="text-color-red">17.01.17</b>
            </li>
            <li>
                Провести конкурс и отправить материалы
                работ необходимо до <b class="text-color-red">01.02.17.</b>
            </li>
            <li>
                Итоги конкурса будут
                размещены на сайте <b class="text-color-red">01.03.17.</b>
            </li>
            <li>
                Наградные материалы будут
                отправлены до <b class="text-color-red">31.03.17</b>
            </li>
        </ul>
    </div>


    <div class="text-center main-block">
        <div class="main-block__title">
            <img src="/images/icons/icon-14.png" alt="Стоимость участия">ПРАВИЛДА УЧАСТИЯ:
        </div>
        <div class="main-rules-block">
            <p>К участию в конкурсе допускаются (без предварительного отбора) учащиеся с 1 по 5 классы,<br>
                оплатившие организационный взнос.</p>
            <p><b class="text-color-red">Предлагаем школьникам посоревноваться в знании изучаемых предметов!</b></p>
        </div>
    </div>

    <div class="text-center main-block">
        <div class="main-block__title">
            <img src="/images/icons/icon-12.png" alt="Стоимость участия">СТОИМОСТЬ УЧАСТИЯ:
        </div>
        <div class="main-price-block row">
            <div class="col-sm-6">
                <div class="main-price-block__item">
                    <div class="main-price-block__title"><b class="text-color-black">60 рублей</b></div>
                    <div class="main-price-block__desc">
                        направляется в оргкомитет<br>
                        организаторам конкурса
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="main-price-block__item">
                    <div class="main-price-block__title"><b class="text-color-black">60 рублей</b></div>
                    <div class="main-price-block__desc">
                        остаются в школе на сопутствующие<br>
                        организационные расходы
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center main-block">
        <div class="main-block__title">
            <img src="/images/icons/icon-15.png" alt="Награждение">НАГРАЖДЕНИЕ:
        </div>
        <div class="main-reward-block row">
            <div class="col-sm-6">
                <div class="main-price-block__item">
                    <div class="main-price-block__title"><b class="text-color-black">Участники</b></div>
                    <div class="main-price-block__desc">
                        Все участники без исключения, получат<br>
                        <b class="text-color-red">сертификаты участников</b>,<br>
                        а наиболее отличившиеся по итогам конкурса -<br>
                        <b class="text-color-red">дипломы I, II, III степени</b>.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="main-price-block__item">
                    <div class="main-price-block__title"><b class="text-color-black">Учителя</b></div>
                    <div class="main-price-block__desc">
                        Всем учителям, задействованным  в подготовке<br>
                        и проведении конкурса в школах,<br>
                        будут выданы <b class="text-color-red">благодарственные письма</b>,<br>
                        наиболее активные организаторы<br>
                        (собравшие более 50 участников)<br>
                        получат <b class="text-color-red">ценные подарки</b>.
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection