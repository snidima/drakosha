<template>
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
            <div class="g-recaptcha" data-sitekey="6LcVABMUAAAAAEoGqerXoZmiWtePUwtWBE7LI7lp" data-callback="recaptchaCallback"></div>
            <button class="btn2 btn2-color1" disabled id="btn-send"><i aria-hidden="true" class="fa fa-paper-plane"></i>Отправить</button>
        </div>
    </form>
</template>



<script>
    const TOKEN = document.querySelector('meta[name="csrf-token"]').content;
    import axios from 'axios';
    var drakajax = axios.create({
        headers: {'X-CSRF-TOKEN' : TOKEN}
    });

    export default {
        props:['action'],
        data () {
            return {
                pending: false
            }
        },
        methods:{
            send () {
                drakajax.post(this.action, {
                    firstName: 'Fred',
                    lastName: 'Flintstone'
                })
                        .then(function (response) {
                            console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
            }
        }
    }
</script>