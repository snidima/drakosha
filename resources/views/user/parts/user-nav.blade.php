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
                    @if( !\App\Order::getForCurrentUser() )
                        <div class="user-nav__title">Подать заявку</div>
                    @else
                        <div class="user-nav__title">Редактировать заявку</div>
                    @endif
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
            @if( $navData['task'] == 'current' )
                <div class="user-nav__item user-nav__item_new">
                    <div class="user-nav__step">3</div>
                    <div class="user-nav__title">Получить задание</div>
                </div>
            @elseif($navData['task'] == 'avail')
                <a href="{{route('user.task')}}" class="user-nav__item user-nav__item_old">
                    <div class="user-nav__step">3</div>
                    <div class="user-nav__title">Получить задание</div>
                </a>
            @else
                <div class="user-nav__item user-nav__item_disabled">
                    <div class="user-nav__step">3</div>
                    <div class="user-nav__title">Получить задание</div>
                </div>
            @endif
            @if( $navData['answer'] == 'current' )
                <div class="user-nav__item user-nav__item_new">
                    <div class="user-nav__step">4</div>
                    <div class="user-nav__title">Отправить ответы</div>
                </div>
            @elseif($navData['answer'] == 'avail')
                <a href="{{route('user.answer')}}" class="user-nav__item user-nav__item_old">
                    <div class="user-nav__step">4</div>
                    <div class="user-nav__title">Отправить ответы</div>
                </a>
            @else
                <div class="user-nav__item user-nav__item_disabled">
                    <div class="user-nav__step">4</div>
                    <div class="user-nav__title">Отправить ответы</div>
                </div>
            @endif
            @if( $navData['results'] == 'current' )
                <div class="user-nav__item user-nav__item_new">
                    <div class="user-nav__step">5</div>
                    <div class="user-nav__title">Узнать результаты</div>
                </div>
            @elseif($navData['results'] == 'avail')
                <a href="{{route('user.results')}}" class="user-nav__item user-nav__item_old">
                    <div class="user-nav__step">5</div>
                    <div class="user-nav__title">Узнать результаты</div>
                </a>
            @else
                <div class="user-nav__item user-nav__item_disabled">
                    <div class="user-nav__step">5</div>
                    <div class="user-nav__title">Узнать результаты</div>
                </div>
            @endif
            <div class="user-nav__item user-nav__item_disabled">
                <div class="user-nav__step">6</div>
                <div class="user-nav__title">Получить награды</div>
            </div>
        </div>
    </div>
</div>