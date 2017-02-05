<div class="menu-top__wrapper">

        {{--<nav class="menu-top">--}}
        <nav class="menu-top  menu-top_mobile-active">
            <div class="menu-top__logo">
                <a href="{{route('main')}}"><img src="/images/logo.png" alt="logo"></a>
            </div>
            <ul class="menu-top__list menu-top__list_main">
                <li><a href="{{route('main')}}">Главная!</a></li>
                {{--<li><a href="#">Правила участия</a></li>--}}
                <li><a href="#">Как принять участие?</a></li>
                <li><a href="{{route('payments')}}">Способы оплаты</a></li>
                <li><a href="#">Контакты</a></li>
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
        <li><a href="#">О проекте</a></li>
        <li><a href="#">Общие положения</a></li>
        <li><a href="#">Критерии</a></li>
        <li><a href="#">Наградные материалы</a></li>
        <li><a href="#">Расписания мероприятий</a></li>
        <li><a href="#">Квитанция на оплату</a></li>
        <li><a href="#">Итоги конкурса</a></li>
        <li><a href="#">Реквизиты</a></li>
    </ul>
</div>