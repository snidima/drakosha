<template>
    <div class="form form-small"  v-bind:class="{ pending: pending}">
        <div class="form__row">
            <label for="pay-method">Выбирите метод оплаты</label>
            <select id="pay-method" v-model="selectPayMethods">
                <option v-for="pay in payMethods" v-bind:value="pay">{{ pay.text }}</option>
            </select>
        </div>
        <form method="post" id="payonline" v-bind:action="action" style="margin-top: 20px" v-if="selectPayMethods.type == '1'" v-on:submit.prevent="sendOnline">
            <input type="hidden" name="shopId" v-model="shopid">
            <input type="hidden" name="scid" v-model="scid">
            <input type="hidden" value="" name="customerNumber" v-model="userid">

            <div class="form__row user-payments__online" v-if="!selectPayMethods.type2">
                Оргкомитет “УМНЫЙ ДРАКОША” <br>комиссию берет на себя!!!
            </div>

            <div class="user-payments__sberbank-com tac" v-if="selectPayMethods.type2">Комиссия 0-1% от суммы</div>

            <div class="form__row" style="margin-bottom: 0">
                <label for="sum">
                    Необходимая сумма: <span class="color1">{{summ}}</span> руб.
                </label>
            </div>
            <div class="form__row flex-lr flex-lr_stretch">
                <input type="text" name="sum" id="sum" v-model="sum" required placeholder="Введите сумму" v-bind:class="{ error: error2 }">
                <button class="btn2 btn2-color1"><i class="fa fa-rub" aria-hidden="true"></i>Оплатить</button>
            </div>
            <p class="form__error" style="text-align: left" v-if="error2">{{error2}}</p>
        </form>

        <form method="post" id="paycheck" v-bind:action="check-action" style="margin-top: 20px" v-if="selectPayMethods.type == '3'" v-on:submit.prevent="sendCheck" enctype="multipart/form-data">
            <div class="user-payments__sberbank-com tac" style="margin-top: -20px;">Комиссия зависит от банка-отправителя</div>
            <div class="form__row">
                <div class="tac" style="margin-bottom: 50px;"><a  style="display: block;width: 100%" href="/files/receipt.docx" class="btn2 btn2-color1"><i class="fa fa-download" aria-hidden="true"></i> Скачать квитанцию ( docx )</a></div>
            </div>
            <div class="form__row">
                <label for="file">Прикрепите скан чека ( jpeg,png,zip,rar )</label>
                <input type="file" name="file" id="file" v-on:change="fileChange">
                <label for="file" class="file-label" v-if="file" v-bind:class="{ 'active': file, error: error }"><i class="fa fa-file" aria-hidden="true"></i>{{ file }}</label>
                <label for="file" class="file-label" v-else v-bind:class="{ error: error }">Выбирите файл</label>
                <p class="form__error" v-if="error">{{error}}</p>
            </div>

            <div class="form__row">
                <button class="btn2 btn2-color1" style="display: block;width: 100%"><i class="fa fa-upload" aria-hidden="true"></i>Прикрепить</button>
            </div>
        </form>
        <div class="form__pending" v-show="pending" style="display: none;">
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
    </div>
</template>


<script>
    export default{
        props:['shopid','scid','action','firstaction','summ', 'userid','checkaction'],
        data(){
            return {
                payMethods:[
                    {
                        text: 'Visa, Master Card, Yandex.Деньги, QIWI',
                        type: '1',

                    },
                    {
                        text: 'Сбербанк-Онлайн',
                        type: '1',
                        type2: true
                    },
                    {
                        text: 'По реквизитам в банке',
                        type: '3'
                    }
                ],
                selectPayMethods: false,
                file: false,
                error: false,
                error2: false,
                pending: false,
                fileSrc: false,
                sum: 0
            }
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
                var action = this.checkaction;
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
                this.$http.post(this.firstaction, {
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

    }
</script>