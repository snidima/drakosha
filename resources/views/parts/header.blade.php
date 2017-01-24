
<div class="top">

</div>


<nav class="menu">
    <div class="menu-left">
        <ul class="menu-list">
            <li class="menu-list__item"><a href="#">Главная</a></li>
            <li class="menu-list__item"><a href="#">Правила участи</a></li>
            <li class="menu-list__item"><a href="#">Правила участи</a></li>
            <li class="menu-list__item"><a href="#">Как принять участие?</a></li>
            <li class="menu-list__item"><a href="#">Способы оплаты</a></li>
            <li class="menu-list__item"><a href="#">Контакты</a></li>
        </ul>
    </div>
    <div class="menu-right">
        <ul class="menu-list">
            @if( Auth::check() )
                <li class="menu-list__item"><a href="{{route('user')}}"><i class="fa fa-user-circle" aria-hidden="true"></i> Личный кабинет</a></li>
                <li class="menu-list__item"><a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Выйти</a></li>
            @else
                <li class="menu-list__item"><a href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Войти</a></li>
                <li class="menu-list__item"><a href="{{route('register')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Регистрация</a></li>
            @endif
        </ul>
    </div>
</nav>


