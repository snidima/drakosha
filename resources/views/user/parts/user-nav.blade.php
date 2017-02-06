<div class="container">

    <h1 class="h1 user-header">
        <b class="color1">{{Auth::user()->name}}</b>, добро пожаловать!<br>
        <small>
            Изменить пароль от личного кабинета вы можете по <a href="{{route('profile')}}">ссылке</a>
        </small>
    </h1>

    <div class="user-nav-wrapper">
        <h2 class="h2"><b class="color1">Внимание!</b> Для того, чтобы успешно завершить участие в конкурсе<br>Вам нужно последовательно выполнить следующие шаги:</h2>
        <div class="user-nav">

            @if( $navData['order'] == 'current' )
                <div class="user-nav__item user-nav__item_new">
                    <div class="user-nav__step">1</div>
                    @if( !\App\Order::getForCurrentUser() )
                        <div class="user-nav__title">Подать заявку</div>
                    @else
                        <div class="user-nav__title">Редактировать заявку</div>
                    @endif
                </div>
            @elseif($navData['order'] == 'avail')
                <a href="{{route('user.order')}}" class="user-nav__item user-nav__item_old">
                    <div class="user-nav__step">1</div>
                    @if( !\App\Order::getForCurrentUser() )
                        <div class="user-nav__title">Подать заявку</div>
                    @else
                        <div class="user-nav__title">Редактировать заявку</div>
                    @endif
                </a>
            @else
                <div class="user-nav__item user-nav__item_disabled">
                    <div class="user-nav__step">1</div>
                    <div class="user-nav__title">Подать заявку</div>
                </div>
            @endif



            @if( $navData['pay'] == 'current' )
                <div class="user-nav__item user-nav__item_new">
                    <div class="user-nav__step">2</div>
                    <div class="user-nav__title">Оплатить</div>
                </div>
            @elseif($navData['pay'] == 'avail')
                <a href="{{route('user.pay')}}" class="user-nav__item user-nav__item_old">
                    <div class="user-nav__step">2</div>
                    <div class="user-nav__title">Оплатить</div>
                </a>
            @else
                <div class="user-nav__item user-nav__item_disabled">
                    <div class="user-nav__step">2</div>
                    <div class="user-nav__title">Оплатить</div>
                </div>
            @endif



            <div class="user-nav__item user-nav__item_disabled">
                <div class="user-nav__step">3</div>
                <div class="user-nav__title">Получить задание</div>
            </div>
            <div class="user-nav__item user-nav__item_disabled">
                <div class="user-nav__step">4</div>
                <div class="user-nav__title">Отправить ответы</div>
            </div>
            <div class="user-nav__item user-nav__item_disabled">
                <div class="user-nav__step">5</div>
                <div class="user-nav__title">Узнать результаты</div>
            </div>
            <div class="user-nav__item user-nav__item_disabled">
                <div class="user-nav__step">6</div>
                <div class="user-nav__title">Получить награды</div>
            </div>
        </div>
    </div>

</div>
{{--<div class="circles text-center">--}}

    {{--<div class="cricle" data-coor="green">--}}
        {{--<a href="{{route('user.order')}}" class="cricle-text">--}}
            {{--<div class="cricle-text__title">Подать заявку</div>--}}
        {{--</a>--}}
    {{--</div>--}}

    {{--<div class="cricle" data-coor="green">--}}
        {{--<a href="{{route('user.pay')}}" class="cricle-text">--}}
            {{--<div class="cricle-text__title">Оплатить</div>--}}
        {{--</a>--}}
    {{--</div>--}}


    {{--<div class="cricle" data-coor="green">--}}
        {{--<a href="{{route('user.answer')}}" class="cricle-text">--}}
            {{--<div class="cricle-text__title">Отправить ответы</div>--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="cricle" data-coor="gray">--}}
        {{--<div class="cricle-text">--}}
            {{--<div class="cricle-text__title">Посмотреть результаты</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="cricle" data-coor="gray">--}}
        {{--<div class="cricle-text">--}}
            {{--<div class="cricle-text__title">Наградные материалы</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}