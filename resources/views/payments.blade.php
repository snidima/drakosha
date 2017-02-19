@extends('layouts/main')

@section('title', 'Способы оплаты')
@section('content')
    <div class="container">
        <h1 class="h1">Способы оплаты</h1>
        <div class="row block">
            <div class="col-sm-3 tac"><img src="/images/payments/yandex_money.png" alt=""></div>
            <div class="col-sm-3 tac"><img src="/images/payments/sberbank.png" alt=""></div>
            <div class="col-sm-3 tac"><img src="/images/payments/Visa.png" alt=""></div>
            <div class="col-sm-3 tac"><img src="/images/payments/master-card.png" alt=""></div>
        </div>

        <p class="tac"><b>Оплатить участие вы можете любым удобным для вас способом:</b></p>

        <ol class="payments block">
            <li class="payments-big">
                <p>
                    <b>Через банк</b>.Обращаем Ваше внимание, что банки могут брать комиссию за проведение платежа.
                    Для этого скачайте и распечатайте квитанцию. Чек необходимо направить  нам в виде сканированной копии в
                    вашем <a href="{{route('user')}}">Личном кабинете</a> <b>выбираете файл и загружаете сканированную копию чека. Только после этого заявка будет отправлена!</b>
                </p>
            </li>
            <li class="payments-big">
                <p>
                    Оплатить онлайн через: <b>Visa/MasterCard, QIWI, Яндекс.Деньги, Сбербанк-Онлайн, Сотовые операторы.</b> <br>Сделать это можно во втором шаге вашего
                    личного кабинета.
                </p>
            </li>
        </ol>

        <p class="warning tac">
            <b class="color1">Способы  оплаты для участников из-за рубежа (не из России)</b><br>
            Участникам из стран СНГ и стран ближнего зарубежья мы настоятельно рекомендуем использовать <br>для оплаты систему платежей <b>QIWI.</b>
        </p>

        <p class="warning tac">
            <b class="color1">Внимание!</b><br>
            Плательщикам иностранных граждан (Белоруссия, Монголия, Казахстан) просим в платежных документах <br>код валютной операции указывать <b>20100</b> !!!
        </p>

        <div class="tac block">
            <a href="/files/receipt.docx" class="btn2 btn2-color1"><i class="fa fa-download" aria-hidden="true"></i>Скачать квитанцию</a>
        </div>
        <p class="warning block">
            <b>Внимание!</b> От уплаты организационного взноса освобождаются участники конкурса из детских домов, дети-инвалиды
            (при официальном запросе от учреждения, который необходимо отправить на электронный ящик).
            В «ШАГ 2» вместо копии квитанции прикрепите сканированную копию любого документа, подтверждающего принадлежность к льготной группе участников.
        </p>

        <div class="h1">
            <span class="color1">Благодарим за доверие!</span><br>
            Желаем вам успешной регистрации и участия в конкурсах!
        </div>

    </div>
@stop