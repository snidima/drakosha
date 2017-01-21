@extends('layouts/main')

@section('content')

    <div class="text-center margin-bottom">
        <div class="text-size-1 condensed text-color-black"><b>УВАЖАЕМЫЕ УЧИТЕЛЯ И ШКОЛЬНЫЕ ОРГАНИЗАТОРЫ!</b></div>
        <p class="text-color-gray">
            Оргкомитет конкурса <b class="text-color-green">«Умный Дракоша»</b> приглашает принять участие<br>
            в конкурсе по различным дисциплинам.
        </p>
    </div>

    <div class="text-center">
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
                    <div class="cricle-text__title">Литературное чтение</div>
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
    </div>
@endsection