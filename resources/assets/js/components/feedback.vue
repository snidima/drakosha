<template>
    <form v-bind:action="action" class="form form-full" style="margin: 0; margin-bottom: 20px;" v-on:submit.prevent="send" v-bind:class="{ pending: pending}">
        <div class="form__row">
            <label for="name">Имя</label>
            <input type="text" name="name" id="name" required placeholder="Имя" v-bind:class="{ error: name.error }" v-model="name.value">
            <p class="form__error" v-if="name.error">{{name.error}}</p>
        </div>
        <div class="form__row">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required placeholder="E-mail" v-bind:class="{ error: email.error }" v-model="email.value">
            <p class="form__error" v-if="email.error">{{email.error}}</p>
        </div>

        <div class="form__row">
            <label for="text">Текст</label>
            <textarea name="text" id="text" required v-bind:class="{ error: text.error }" v-model="text.value"></textarea>
            <p class="form__error" v-if="text.error">{{text.error}}</p>
        </div>
        <div class="form__action">
            <button class="btn2 btn2-color1" id="btn-send"><i aria-hidden="true" class="fa fa-paper-plane"></i>Отправить</button>
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
    const TOKEN = document.querySelector('meta[name="csrf-token"]').content;
    import axios from 'axios';
    var drakajax = axios.create({
        headers: {'X-CSRF-TOKEN' : TOKEN}
    });


    export default {
        props:['action'],
        data : function() {
            return {
                name: {
                    value: '',
                    error: false
                },
                email: {
                    value: '',
                    error: false
                },
                subject: {
                    value: '',
                    error: false
                },
                text: {
                    value: '',
                    error: false
                },
                pending: false
            }
        },
        computed:{
          all : function() {
              return {
                  name: this.name.value,
                  email: this.email.value,
                  subject: this.subject.value,
                  text: this.text.value
              }
          }
        },
        methods:{
            send : function() {
                this.pending = true;
                var self = this;
                drakajax.post(this.action, this.all)
                        .then(function (response) {
                            self.pending = false;
                            console.log(response.response);
                            vex.dialog.alert({
                                message: 'Форма успешно обработана!',
                                callback: function(){
                                    window.location.href = '/';
                                }
                            })
                        })
                        .catch(function (error) {

                            self.pending = false;
                            _.forOwn(self.all, function (e,a) {
                                if ( error.response.data[a] )
                                    self[a].error = error.response.data[a][0];
                                else
                                    self[a].error = false;
                            });
                        });
            }
        }
    }
</script>