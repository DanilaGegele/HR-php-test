<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Список заказов
                    </div>

                    <div class="panel-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="overdue-tab" data-toggle="tab" href="#overdue" role="tab"
                                   aria-controls="profile"
                                   aria-selected="false"
                                   @click="loadOrder('Overdue')">Просроченные</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="current-tab" data-toggle="tab" href="#current" role="tab"
                                   aria-controls="profile"
                                   aria-selected="false"
                                   @click="loadOrder('Current')">Текущие</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="new-tab" data-toggle="tab" href="#new" role="tab"
                                   aria-controls="contact"
                                   aria-selected="false"
                                   @click="loadOrder('New')">Новые</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="fulfilled-tab" data-toggle="tab" href="#fulfilled" role="tab"
                                   aria-controls="contact"
                                   @click="loadOrder('Fulfilled')"
                                   aria-selected="false">Выполненные</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="overdue" role="tabpanel"
                                 aria-labelledby="overdue-tab">
                                <OrderList v-if="activeTab === 'Overdue'"
                                           :listOrder=listOrder></OrderList>
                            </div>
                            <div class="tab-pane fade" id="current" role="tabpanel" aria-labelledby="current-tab">
                                <OrderList v-if="activeTab === 'Current'"
                                           :listOrder=listOrder></OrderList>
                            </div>
                            <div class="tab-pane fade" id="new" role="tabpanel" aria-labelledby="new-tab">
                                <OrderList v-if="activeTab === 'New'"
                                    :listOrder=listOrder></OrderList>
                            </div>
                            <div class="tab-pane fade" id="fulfilled" role="tabpanel" aria-labelledby="fulfilled-tab">
                                <OrderList v-if="activeTab === 'Fulfilled'"
                                           :listOrder=listOrder></OrderList>
                            </div>
                            <Paginate
                                    :data="listOrder"
                                    @pagination-change-page="getResults"></Paginate>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import OrderList from "./OrderList";
    import Paginate from "laravel-vue-pagination";

    export default {
        components: {
            OrderList,
            Paginate
        },
        data() {
            return {
                activeTab: '',
                listOrder: {}
            }
        },
        methods: {
            /**
             * Загрузка данных для вкладки список заказов
             *
             * @param type
             **/
            loadOrder(type) {
                let app = this;
                axios.get('/api/v1/loadOrder'+type)
                    .then(response => {
                        this.activeTab = type;
                        if(response.data.data){
                            app.listOrder = response.data;
                        } else {
                            app.listOrder = response;
                        }
                    });
            },
            /**
             * Изменение пагинации
             *
             * @param page
             */
            getResults: function (page = 1) {
                let app = this;
                axios.get(this.listOrder.path+'?page=' + page)
                    .then(response => {
                        if(response.data.data){
                            app.listOrder = response.data;
                        } else {
                            app.listOrder = response;
                        }
                    });
            }
        }

    }
</script>
