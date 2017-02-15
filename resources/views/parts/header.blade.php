<div class="contacts-menu__wrapper">
    <div class="container">
        <div class="contacts-menu">
            <a href="#" class="contacts-menu__item">
                <i class="fa fa-phone" aria-hidden="true"></i> 8-(800)-236-5677
            </a>
            <a href="#" class="contacts-menu__item">
                <i class="fa fa-envelope" aria-hidden="true"></i> info@drakosha-olimpiada.ru
            </a>
            <div class="contacts-menu__item">
                <i class="fa fa-clock-o" aria-hidden="true"></i> С 7:00-15:00 по МСК ( воскресенье - выходной )
            </div>
        </div>
    </div>
</div>
<div class="menu-top__wrapper">
    {{--<nav class="menu-top">--}}
    <nav class="menu-top  menu-top_mobile-active">
        <div class="menu-top__logo">
            <a href="{{route('main')}}"><img src="/images/logo2.png" alt="logo"></a>
        </div>
        <ul class="menu-top__list menu-top__list_main">
            <li><a href="{{route('main')}}">Главная!</a></li>
            <li><a href="{{route('rules')}}">Правила участия</a></li>
            <li><a href="{{route('how')}}">Как принять участие?</a></li>
            <li><a href="{{route('payments')}}">Способы оплаты</a></li>
            <li><a href="{{route('contacts')}}">Контакты</a></li>
        </ul>
        <ul class="menu-top__list menu-top__list_acc">
            @if( Auth::check() )
                <li><a href="{{route('user')}}" class="btn btn-color1"><i class="fa fa-user" aria-hidden="true"></i>Личный кабинет</a></li>
                <li><a href="{{route('logout')}}" class="btn btn-trans btn-color1"><i class="fa fa-sign-out" aria-hidden="true"></i>Выйти</a></li>
            @else
                <li><a href="{{route('login')}}" class="btn btn-color1"><i class="fa fa-sign-in" aria-hidden="true"></i>Войти</a></li>
                <li><a href="{{route('register')}}" class="btn btn-trans btn-color1"><i class="fa fa-unlock" aria-hidden="true"></i>Регистрация</a></li>
            @endif
        </ul>
    </nav>
</div>
<div class="menu-bottom__wrapper">
    <ul class="menu-bottom">
        <li><a href="{{route('about')}}">О проекте</a></li>
        <li><a href="{{route('provisions')}}">Общие положения</a></li>
        <li><a href="{{route('criteria')}}">Критерии</a></li>
        <li><a href="#">Наградные материалы</a></li>
        <li><a href="{{route('schedule')}}">Расписания мероприятий</a></li>
        <li><a href="#">Итоги конкурса</a></li>
    </ul>
</div>