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
            <div class="col-md-5">
                <div class="h2">Обратная связь</div>
                <form action="" class="form form-full" style="margin: 0; margin-bottom: 10px;">
                    <div class="form__row">
                        <label for="name">Имя</label>
                        <input type="text" name="name" id="name" required placeholder="Имя">
                    </div>
                    <div class="form__row">
                        <label for="subject">Тема</label>
                        <input type="text" name="subject" id="subject" required placeholder="Тема вопроса">
                    </div>
                    <div class="form__row">
                        <label for="subject">Текст</label>
                        <textarea name="" id=""></textarea>
                    </div>
                    <div class="form__action flex-lr">
                        <div class="g-recaptcha" data-sitekey="6LcVABMUAAAAAEoGqerXoZmiWtePUwtWBE7LI7lp" data-callback="recaptchaCallback" v-bind:class="{ error: 'g-recaptcha-response'.error }"></div>
                        <button class="btn2 btn2-color1" disabled id="btn-send"><i aria-hidden="true" class="fa fa-paper-plane"></i>Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection