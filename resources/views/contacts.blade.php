@extends('layouts/main')

@section('title', 'Кнтакты')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="h2">Контакты</div>
                <p class="block">
                    <b>Наш почтовый адрес:</b><br> 659316 Алтайский край, город Бийск а/я
                </p>
                <p class="block">
                    <b>Наш юридический адрес:</b><br> Алтайский край, город Бийск, ул. Можайского 13
                </p>
                <p class="block">
                    <b>Служба поддержки:</b>

                </p>
                <p class="block">
                    <b>E-mail поддержки:</b><br><a href="mailto:info@drakosha-olimpiada.ru">info@drakosha-olimpiada.ru</a>


            </div>
            <div class="col-md-5" id="feedback">
                <div class="h2">Обратная связь</div>
                <feedback action="{{route('feedback')}}"></feedback>
            </div>
        </div>
    </div>
@endsection