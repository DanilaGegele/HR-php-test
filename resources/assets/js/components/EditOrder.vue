<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Редактировния заказа {{ $route.params.id }}</h1>
                    </div>
                    <div class="panel-body">

                        <form v-on:submit.prevent="checkForm">
                            <div class="form-group">
                                <label for="clientEmail">email клиента</label>
                                <input type="email"
                                       class="form-control"
                                       id="clientEmail"
                                       placeholder="email клиента"
                                       v-model="orderData.client_email"
                                       required>
                                <small id="emailHelp"
                                       class="form-text text-muted has-error"
                                       v-if="getError('client_email')">{{getError('client_email')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="partnersItem">Партнёр</label>
                                <select v-model="orderData.partner_id" class="form-control" id="partnersItem">
                                      <option v-for="partnersItem in partnersList"
                                              v-bind:value="partnersItem.id">{{partnersItem.name}}</option>
                                </select>
                                <small class="form-text text-muted has-error"
                                       v-if="getError('partner_id')">{{getError('partner_id')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="status">Статус</label>
                                <select v-model="orderData.status" class="form-control" id="status">
                                    <option v-for="(item,index) in arStatus"
                                            v-bind:value="index">{{item}}</option>
                                </select>
                                <small class="form-text text-muted has-error"
                                       v-if="getError('status')">{{getError('status')}}</small>
                            </div>
                            <h4>Продукты</h4>
                            <hr/>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Название продукта</th>
                                            <th scope="col">кол-во</th>
                                            <th scope="col">стоимость</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="productItem in orderData.product">
                                        <td>
                                            {{productItem.name}}
                                        </td>
                                        <td>
                                            {{productItem.pivot.quantity}}
                                        </td>
                                        <td>{{getSum(productItem)}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <b>Итого: {{getTotal()}}</b>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <b  v-if="message">
                                {{message}}
                            </b>
                        </form>
                        <router-link class="nav-item"
                                     to="/">
                            <span class="active-item-here"></span><i class="fa fa-dashboard mr-5"></i> <span> Вернуться к списоку заказов</span>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: 'edit-order',
        data() {
            return {
                orderData: {}, // заказ
                arStatus: {
                    0: 'новый',
                    10: 'подтвержден',
                    20: 'завершен'
                },
                message: '',
                partnersList: {}, // список портнёров
                totalSum: 0,
                error: {}
            }
        },
        methods:{
            checkForm: function () {
                axios.post('/api/v1/updateOrder/'+this.$route.params.id,{
                    client_email: this.orderData['client_email'],
                    status: this.orderData['status'],
                    partner_id: this.orderData['partner_id']
                }).then(response => {
                    this.message = 'Данные заказа обновлены';
                }).catch(error => {
                    this.error = error.response.data.errors
                })
            },
            /**
             * Вывести сумму
             *
             * @param productItem <array>
             * @return {number}
             */
            getSum: function (productItem) {
                return productItem.pivot.quantity * productItem.price;
            },
            /**
             * Вывести итоговую сумму
             *
             * @return {number}
             */
            getTotal: function () {
                let total = 0;
                if(this.orderData['product']){
                    this.orderData['product'].forEach(function(element) {
                        total+= element.pivot.price * element.pivot.quantity;
                    });
                }
                return total
            },
            /**
             * Вывести ошибку по соотвествующиму полю
             *
             * @param index
             * @return {boolean}
             */
            getError: function(index) {
                return this.error[index] ? this.error[index][0] : false;
            }


        },
        mounted() {
            this.$nextTick(function () {
                /**
                 * Загрузить данные по определённому заказу
                 */
                axios.get('/api/v1/getOrder/'+this.$route.params.id)
                    .then(response => {
                        this.orderData = response.data;
                    });

                /**
                 * Загрузить список партнёров
                 */
                axios.get('/api/v1/getPartnersList')
                    .then(response => {
                        this.partnersList = response.data;
                    });



            });

        }
    }
</script>
