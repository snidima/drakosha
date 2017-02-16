<template>
    <form v-bind:action="action" class="form form-large" v-bind:class="{ pending: pending}" id="form-register" method="post" v-on:submit.prevent="send">
        <div class="row">
            <div class="col-md-6">
                <div class="form__row">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" required v-model="email.value" placeholder="E-mail" v-bind:class="{ error: email.error }">
                    <p class="form__error" v-if="email.error">{{email.error}}</p>
                </div>
                <div class="form__row">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" required id="password" v-model="password.value" placeholder="Пароль" v-bind:class="{ error: password.error }">
                    <p class="form__error" v-if="password.error">{{password.error}}</p>
                </div>
                <div class="form__row">
                    <label for="password_confirmation">Пароль еще раз</label>
                    <input type="password" name="password_confirmation" required id="password_confirmation" v-model="password_confirmation.value" placeholder="Пароль еще раз">
                </div>
                <div class="form__row">
                    <div class="g-recaptcha" data-callback="recaptchaOK" data-sitekey="6LcVABMUAAAAAEoGqerXoZmiWtePUwtWBE7LI7lp" v-bind:class="{ error: 'g-recaptcha-response'.error }"></div>
                </div>
                <div class="form__row" style="text-align: left">
                    <button class="btn2 btn2-color1" disabled id="btn-send"><i class="fa fa-unlock" aria-hidden="true"></i>Регистрация</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form__row">
                    <label for="surname">Фамилия</label>
                    <input type="text" name="surname" required id="surname" v-model="surname.value" placeholder="Фамилия" v-bind:class="{ error: surname.error }">
                    <p class="form__error" v-if="surname.error">{{surname.error}}</p>
                </div>
                <div class="form__row">
                    <label for="name">Имя</label>
                    <input type="text" name="name" required id="name" v-model="name.value" placeholder="Имя" v-bind:class="{ error: name.error }">
                    <p class="form__error" v-if="name.error">{{name.error}}</p>
                </div>
                <div class="form__row">
                    <label for="lastname">Отчество</label>
                    <input type="text" name="lastname" required id="lastname" v-model="lastname.value" placeholder="Отчество" v-bind:class="{ error: lastname.error }">
                    <p class="form__error" v-if="lastname.error">{{lastname.error}}</p>
                </div>
                <div class="form__row">
                    <label for="country">Страна</label>
                    <input type="text" name="country" required id="country" v-model="country.value" placeholder="Страна" v-bind:class="{ error: country.error }">
                    <p class="form__error" v-if="country.error">{{country.error}}</p>
                </div>

            </div>
        </div>

        <div class="form__pending" v-if="pending">
            <div class="form__pending-wrapper">
                <div class="sk-circle">
                    <div class="sk-circle1 sk-child"></div>
                    <div class="sk-circle2 sk-child"></div>
                    <div class="sk-circle3 sk-child"></div>
                    <div class="sk-circle4 sk-child"></div>
                    <div class="sk-circle5 sk-child"></div>
                    <div class="sk-circle6 sk-child"></div>
                    <div class="sk-circle7 sk-child"></div>
                    <div class="sk-circle8 sk-child"></div>
                    <div class="sk-circle9 sk-child"></div>
                    <div class="sk-circle10 sk-child"></div>
                    <div class="sk-circle11 sk-child"></div>
                    <div class="sk-circle12 sk-child"></div>
                </div>
            </div>
        </div>
    </form>
</template>


<script>



    export default{
        props:['action'],
        data(){
            return {
                pending: false,
                email: {
                    value: '',
                    error: false
                },
                password: {
                    value: '',
                    error: false
                },
                password_confirmation: {
                    value: '',
                    error: false
                },
                name: {
                    value: '',
                    error: false
                },
                surname: {
                    value: '',
                    error: false
                },
                lastname:{
                    value: '',
                    error: false
                },
                country:{
                    value: '',
                    error: false
                },
                'g-recaptcha-response': {
                    value: '',
                    error: false
                }


            }
        },
        computed:{
            all: function(){
                return {
                    email: this.email.value,
                    password: this.password.value,
                    password_confirmation: this.password_confirmation.value,
                    name: this.name.value,
                    surname: this.surname.value,
                    lastname: this.lastname.value,
                    country: this.country.value,
                    'g-recaptcha-response': $('[name="g-recaptcha-response"]').val()
                };
            }
        },

        created(){
            window.recaptchaOK = this.recaptchaTrue;
        },

        methods: {
            recaptchaTrue: function( r ){
                this['g-recaptcha-response'].value = r;
                $(this.$el).find('#btn-send').removeAttr('disabled');
            },
            send: function(){
                var self = this;
                this.pending = true;
                this.$http.post('/register', this.all).then(function(response) {
                    self.pending = false;
                    vex.dialog.alert({
                        message: 'Для регистрации необхадима активация аккаунта! Проверьте почту и следуйте дальнейшим инструкциям!',
                        callback: function(){
                            window.location.href = response.body.redirect;
                        }
                    })
                }, function(response) {
                    self.pending = false;
                    _.forOwn(self.all, function (e,a) {
                        if ( response.body[a] )
                            self[a].error = response.body[a][0];
                        else
                            self[a].error = false;
                    });

                });
                return false;
            }
        }
    }
</script>

