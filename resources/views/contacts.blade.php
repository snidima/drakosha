@extends('layouts/main')

@section('title', 'Кнтакты')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="h2">Контакты</div>
                <p>
                    <b>Наш почтовый адрес:</b><br> 659316 Алтайский край, город Бийск а/я
                </p>
                <p>
                    <b>Наш юридический адрес:</b><br> Алтайский край, город Бийск, ул. Можайского 13
                </p>
                <p>
                    <b>Служба поддержки:</b>

                </p>
                <p>
                    <b>E-mail поддержки:</b><br><a href="mailto:info@drakosha-olimpiada.ru">info@drakosha-olimpiada.ru</a>


            </div>
            <div class="col-md-5" id="feedback">
                <div class="h2">Обратная связь</div>
                <feedback></feedback>
            </div>
        </div>
    </div>
@endsection