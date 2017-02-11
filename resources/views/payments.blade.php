@extends('layouts/main')

@section('title', 'Конкурс для младших классов')
@section('content')
    <div class="container">
        <h1 class="h1">Способы оплаты</h1>
        <div class="row block">
            <div class="col-sm-3 tac"><img src="/images/payments/yandex_money.png" alt=""></div>
            <div class="col-sm-3 tac"><img src="/images/payments/sberbank.png" alt=""></div>
            <div class="col-sm-3 tac"><img src="/images/payments/Visa.png" alt=""></div>
            <div class="col-sm-3 tac"><img src="/images/payments/master-card.png" alt=""></div>
        </div>
        <ol class="payments block">
            <li>
                <p>
                    <b>Через банк</b>. Для этого скачайте и распечатайте квитанцию. Чек необходимо направить  нам в виде сканированной копии
                    в вашем Личном кабинете выбираете файл и загружаете сканированную копию чека. Только после этого заявка будет
                    отправлена!
                </p>
            </li>
            <li>
                <p>
                    Оплатить онлайн <b>Яндекс.Деньгами</b> или <b>банковской картой</b>. Сделать это можно во втором шаге вашего
                    личного кабинета.
                </p>
            </li>
        </ol>
        <div class="tac block">
            <a href="#" class="btn2 btn2-color1"><i class="fa fa-download" aria-hidden="true"></i>Скачать квитанцию</a>
        </div>
        <p class="warning block">
            <b>Внимание!</b> От уплаты организационного взноса освобождаются участники конкурса из детских домов, дети-инвалиды
            (при официальном запросе от учреждения, который необходимо отправить на электронный ящик).
            В «ШАГ 2» вместо копии квитанции прикрепите сканированную копию любого документа, подтверждающего принадлежность к льготной группе участников.
            <br><b>С уважением, администраторы сайта</b>
        </p>

    </div>
@stop