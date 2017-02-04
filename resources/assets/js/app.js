// var Vue = require('vue');
window.$ = require('jquery');
const TOKEN = document.querySelector('meta[name="csrf-token"]').content;

Vue.http.interceptors.push((request, next) => {
    request.method = 'POST';
    request.headers.set('X-CSRF-TOKEN', TOKEN);
    next();
});




var app = new Vue({
    el: '#app',
    data: {
        formData: {
            email: '',
            password: '',
            saveMe: true
        },
        errors: false

    },
    methods:{
        send: function(){

            this.$http.post('/login', this.formData).then(function(response) {

                window.location.href = "/userzone";

            }, function(response) {
                vex.dialog.alert({
                    message: 'Введены не верные Email/Пароль',
                    // className: 'vex-theme-wireframe' // Overwrites defaultOptions
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