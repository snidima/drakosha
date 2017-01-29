<div class="circles text-center">
    @if( $params['newOrderAvailable'] )
    <div class="cricle" data-coor="green">
        <a href="{{route('user.order')}}" class="cricle-text">
            <div class="cricle-text__title">Подать заявку</div>
        </a>
    </div>
    @else
    <div class="cricle" data-coor="blue">
        <a href="{{route('user.order')}}" class="cricle-text">
            <div class="cricle-text__title">Редактировать заявку</div>
        </a>
    </div>
    @endif

    @if( $params['newOrderAvailable'] )
    <div class="cricle" data-coor="gray">
        <div class="cricle-text">
            <div class="cricle-text__title">Оплатить</div>
        </div>
    </div>
    @else
    <div class="cricle" data-coor="green">
        <a href="{{route('user.pay')}}" class="cricle-text">
            <div class="cricle-text__title">Оплатить</div>
        </a>
    </div>
    @endif

    <div class="cricle" data-coor="green">
        <a href="{{route('user.answer')}}" class="cricle-text">
            <div class="cricle-text__title">Отправить ответы</div>
        </a>
    </div>
    <div class="cricle" data-coor="gray">
        <div class="cricle-text">
            <div class="cricle-text__title">Посмотреть результаты</div>
        </div>
    </div>
    <div class="cricle" data-coor="gray">
        <div class="cricle-text">
            <div class="cricle-text__title">Наградные материалы</div>
        </div>
    </div>
</div>