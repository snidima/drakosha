<template>
    <form v-bind:action="action" class="form form-small" id="form-login" method="post" v-bind:class="{ pending: pending }" v-on:submit.prevent="send">
        <div class="form__row">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required placeholder="E-mail">
        </div>
        <div class="form__row">
            <label for="password">Пароль</label>
            <input type="password" name="password" required id="password" placeholder="Пароль">
        </div>
        <div class="form__row">
            <button class="btn btn-color1"><i class="fa fa-sign-in" aria-hidden="true"></i>Войти</button>
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