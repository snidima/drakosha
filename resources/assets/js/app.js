window.$ = require('jquery');
window._ = require('lodash');

window.vex = require('vex-js');
window.vex.registerPlugin(require('vex-dialog'));
window.vex.defaultOptions.className = 'vex-theme-default';

var axios = require('axios');
var Vue = require('vue');
Vue.use(require('vue-resource'));

Vue.config.debug = false;
Vue.config.silent = true;


var Tooltip = require('tether-tooltip');



import Feedback from './components/feedback.vue';
import Register from './components/register.vue';

Vue.component( 'feedback', Feedback );
Vue.component( 'register', Register );



let feedback = new Vue({
    el: '#feedback'
});

let  register = new Vue({
    el: '#register'
});





const TOKEN = document.querySelector('meta[name="csrf-token"]').content;


Vue.http.interceptors.push((request, next) => {
    request.method = 'POST';
    request.headers.set('X-CSRF-TOKEN', TOKEN);
    next();
});






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
        // learner:{
        //     value: '',
        //     error: false
        // },
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
                // learner: this.learner.value,
                teacher_learner: this.teacher_learner.value,
                phone: this.phone.value,
                reward: this.reward.value,
            };
        },
        defaultRewardD: function()
        {
            var self = this;
            var res = _.map(this.defaultReward, function(e){
                var res = {};
                if( ( e == 'Почта России' && self.sert_count.value < 20 ) ) {
                    if (self.reward.value =='Почта России' )
                        self.reward.value  = 'Электронный вариант';

                    res = {
                        value: e,
                        avail: true
                    };
                } else {
                    res = {
                        value: e,
                        avail: false
                    };
                }

                return res
            });
            return res;

        },

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
                type: 'online'
            },
            {
                text: 'Visa/Master Card',
                type: 'online'
            },
            {
                text: 'QIWI',
                type: 'online'
            },
            {
                text: 'Сбербанк-онлайн',
                type: 'online'
            },
            {
                text: 'Баланс телефона',
                type: 'online'
            },
            {
                text: 'С помощью квитанции',
                type: 'offline'
            }
        ],
        selectPayMethods: false,
        file: false,
        error: false,
        error2: false,
        pending: false,
        fileSrc: false,
        sum: 0
    },

    created: function(){
      this.selectPayMethods = this.payMethods[0]
    },
    methods:{
        sendCheck: function(){
            if ( !this.file ) {
                this.error = 'Прикрепите файл';
                return;
            }
            var action = $(this.$el).find('#paycheck').attr('action');
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
            }
        },

        sendOnline: function () {
            var self = this;
            this.pending = true;
            this.$http.post($(this.$el).find('#payonline').attr('data-first-action'), {
                money: this.sum
            }).then(function(response) {
                self.pending = false;
                vex.dialog.confirm({
                    message: response.body.message,
                    callback: function (value) {
                        if(value){
                            $(self.$el).find('#payonline').submit();
                        }
                    },
                    buttons: [
                        $.extend({}, vex.dialog.buttons.YES, { text: 'Перейти' }),
                        $.extend({}, vex.dialog.buttons.NO, { text: 'Отмена' })
                    ],
                })
            }, function(response) {
                self.pending = false;
                self.error2 = response.body.money[0];
            });
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









if ( $('#order-edit-warning').length >0 )
    vex.dialog.alert({
        message: $('#order-edit-warning').html(),
    })



if ( $('#orgs2').length >0 )
new Tooltip({
    target: document.querySelector('#orgs2'),
    content: "В этом поле необходимо указать<br> количество участников в каждом классе<br>по кажому предмету",
    position: 'top center'
});

if ( $('#sert').length >0 )
new Tooltip({
    target: document.querySelector('#sert'),
    content: "Отправка сертификатов Почтой России<br> возможна только <span>от 20 сертифкатов</span>",
    position: 'top center'
});