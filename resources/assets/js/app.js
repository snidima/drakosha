// var Vue = require('vue');
window.$ = require('jquery');
window._ = require('lodash');
const TOKEN = document.querySelector('meta[name="csrf-token"]').content;


Vue.http.interceptors.push((request, next) => {
    request.method = 'POST';
    request.headers.set('X-CSRF-TOKEN', TOKEN);
    next();
});




var register = new Vue({
    el: '#form-register',
    data: {
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
        'g-recaptcha-response': {
            value: '',
            error: false
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
                'g-recaptcha-response': $('[name="g-recaptcha-response"]').val()
            };
        }
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
});

window.recaptchaCallback = register.recaptchaTrue;




var login = new Vue({
    el: '#form-login',
    data: {
        formData: {
            email: '',
            password: '',
            saveMe: true
        }
    },
    methods:{
        send: function(){

            this.$http.post('/login', this.formData).then(function(response) {

                window.location.href = "/userzone";

            }, function(response) {
                vex.dialog.alert({
                    message: 'Введены не верные Email/Пароль',
                })
            });

            return false;
        }
    }
});









//
// function defaultAjax(url, params, btn) {
//     btn.addClass('loading');
//     return new Promise(function(success, fail){
//         $.ajax({
//             type: "POST",
//             dataType: "json",
//             url: url,
//             data: params,
//             success: function( d ){
//                 success( d );
//                 btn.removeClass('loading');
//             },
//             error: function( d ){
//                 fail( fail );
//                 btn.removeClass('loading');
//             }
//         });
//     });
// }
//
//
// $('.form-ajax').submit( function(){
//     event.preventDefault();
//
//     defaultAjax( $(this).attr('action'), $(this).serialize(), $(this).find('input[type="submit"]') ).then(
//         function(d){
//             alert('ok');
//         },
//         function(d){
//             alert('no');
//         }
//     );
//
//
//
// });