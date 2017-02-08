window.$ = require('jquery');
window._ = require('lodash');
var axios = require('axios');
var Vue = require('vue');
Vue.use(require('vue-resource'));



var vex = require('vex-js');
vex.registerPlugin(require('vex-dialog'));
vex.defaultOptions.className = 'vex-theme-default';

const TOKEN = document.querySelector('meta[name="csrf-token"]').content;


Vue.http.interceptors.push((request, next) => {
    request.method = 'POST';
    request.headers.set('X-CSRF-TOKEN', TOKEN);
    next();
});



if ( $('#form-register').length >0 ) {

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
}


if ( $('#form-login').length >0 )
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

                window.location.href = response.body.redirect;

            }, function(response) {
                vex.dialog.alert({
                    message: response.body.error
                })
            });

            return false;
        }
    }
});





if ( $('#form-reset').length >0 )
var reset = new Vue({
    el: '#form-reset',
    data: {
        formData: {
            password_confirmation: '',
            password: '',
        }
    },
    methods:{
        send: function(){

            this.$http.post(location.pathname, this.formData).then(function(response) {
                vex.dialog.alert({
                    message: 'Пароль успешно сохранен! Войдите с новыми данными',
                    callback: function(){
                        window.location.href = response.body.redirect;
                    }
                })
            }, function(response) {
                vex.dialog.alert({
                    message: response.body.password[0]
                })
            });
            return false;
        }
    }
});






if ( $('#order').length >0 )
var order = new Vue({
    el: '#order',
    data: {
        pending: false,
        org_num: {
            value: '',
            error: false
        },
        region: {
            value: '',
            error: false
        },
        city: {
            value: '',
            error: false
        },
        address: {
            value: '',
            error: false
        },
        postcode: {
            value: '',
            error: false
        },
        school:{
            value: '',
            error: false
        },
        sert_count:{
            value: '',
            error: false
        },
        learner:{
            value: '',
            error: false
        },
        teacher_learner:{
            value: '',
            error: false
        },
        phone:{
            value: '',
            error: false
        },
        reward:{
            value: '',
            error: false
        },
        defaultReward:[]

    },
    computed:{
        all: function(){
            return {
                org_num: this.org_num.value,
                region: this.region.value,
                city: this.city.value,
                address: this.address.value,
                postcode: this.postcode.value,
                school: this.school.value,
                sert_count: this.sert_count.value,
                learner: this.learner.value,
                teacher_learner: this.teacher_learner.value,
                phone: this.phone.value,
                reward: this.reward.value,
            };
        }
    },
    created: function(){
        this.pending = true;
        var self = this;
        this.$http.post('/userzone/order/getDefault').then(
            function(response) {
                _.forOwn(self.all, function (e,a) {
                    if ( response.body.data[a] )
                        self[a].value = response.body.data[a];
                    else
                        self[a].value = false;
                });
                self.defaultReward = response.body.rewards;

                self.pending = false;
            },
            function(response){
                self.defaultReward = response.body.rewards;
                self.reward.value = response.body.rewards[0];
                self.pending = false;
                console.log( self.defaultReward);
            });
    },



    methods: {

        send: function(){
            var self = this;
            this.pending = true;
            this.$http.post('/userzone/order', this.all).then(function(response) {
                self.pending = false;
                vex.dialog.alert({
                    message: 'Ваша заявка успешно обработана!',
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



if ( $('#user-pay').length >0 )
var payment = new Vue({
    el: '#user-pay',
    data: {
        payMethods:[
            {
                text: 'Yandex.Деньги',
                value: 'ya',
            },
            {
                text: 'С помощью квитанции',
                value: 'check',
            }

        ],
        selectPayMethods: false,
        file: false,
        error: false,
        pending: false,
        fileSrc: false
    },
    created: function(){
      this.selectPayMethods = this.payMethods[0].value
    },
    methods:{
        sendCheck: function(){
            if ( !this.file ) {
                this.error = 'Прикрепите файл';
                return;
            }
            var action = '/userzone/paycheck';
            var self = this;
            this.pending = true;

            var formData = new FormData();
            formData.append('file', this.fileSrc);

            this.$http.post(action, formData).then(function(response) {
                self.pending = false;
                vex.dialog.alert({
                    message: 'Чек успешно загружен!',
                    callback: function(){
                        window.location.href = response.body.redirect;
                    }
                })
            }, function(response) {
                self.pending = false;
                self.error = response.body.file[0];
            });
        },
        fileChange: function(e){
            var filename = e.target.files[0].name;
            if( filename ){
                this.file = filename;
                this.error = false;
                this.fileSrc = e.target.files[0];
                console.log( this.fileSrc )
            }
        }
    }
});





if ( $('#upload-answer').length >0 )
var answer = new Vue({
    el: '#upload-answer',
    data: {
        file: false,
        error: false,
        pending: false,
        fileSrc: false
    },
    methods:{

        send: function(){
            if ( !this.file ) {
                this.error = 'Прикрепите файл';
                return;
            }
            var action = $(this.$el).attr('action');
            var self = this;
            this.pending = true;

            var formData = new FormData();
            formData.append('file', this.fileSrc);

            this.$http.post(action, formData).then(function(response) {
                self.pending = false;
                vex.dialog.alert({
                    message: 'Ответы успешно загружены!',
                    callback: function(){
                        window.location.href = response.body.redirect;
                    }
                })
            }, function(response) {
                self.pending = false;
                self.error = response.body.file[0];
            });
        },

        fileChange: function(e){
            var filename = e.target.files[0].name;
            if( filename ){
                this.file = filename;
                this.error = false;
                this.fileSrc = e.target.files[0];
                console.log( this.fileSrc )
            }

        }
    }
});

















if ( $('#change-password').length >0 )
var changePassword = new Vue({
    el: '#change-password',
    data: {
        pending: false,
        old_password: {
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
    },
    computed:{
        all: function(){
            return {
                old_password: this.old_password.value,
                password: this.password.value,
                password_confirmation: this.password_confirmation.value,
            };
        }
    },
    methods: {
        send: function(){
            var self = this;
            this.pending = true;
            var action = $(this.$el).attr('action');
            this.$http.post(action, this.all).then(function(response) {
                self.pending = false;
                vex.dialog.alert({
                    message: 'Пароль успешно изменен!',
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









// Vue.component('file-component', {
//     template: '#template-file',
//     props: ['title','text','name'],
//     data: function(){
//         return{
//             file: false
//         }
//     },
//     methods:{
//         fileChange: function(e){
//             var fullPath = e.target.value;
//             var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
//             var filename = fullPath.substring(startIndex);
//             if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
//                 filename = filename.substring(1);
//             }
//             this.file = filename;
//         }
//     }
// });




$('#reset-btn').click(function(){
    vex.dialog.prompt({
        message: 'Введите свой E-mail: ',
        placeholder: 'E-mail',
        callback: function(email){

            if ( !email ) return;
            axios.post('/resets', {
                email: email
            })
                .then(function (response) {

                    vex.dialog.alert({
                        message: 'На ваш E-mail отправлено пиьсмо с инструкцией по восстановлению',
                    })

                })
                .catch(function (error) {
                    vex.dialog.alert({
                        message: error.response.data.email[0]+' Попробуйте еще раз',
                        callback: function(){
                            $('#reset-btn').trigger('click');
                        }
                    })
                });

        },
        buttons: [
            $.extend({}, vex.dialog.buttons.YES, { text: 'Восстановить' }),
            $.extend({}, vex.dialog.buttons.NO, { text: 'Отмена' })
        ],
    })
});