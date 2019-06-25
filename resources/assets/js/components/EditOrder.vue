<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактировния заказа {{ $route.params.id }}</div>

                    <div class="panel-body">

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
                productList: {}, // список продукции
                partnersList: {}, // список портнёров
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

                /**
                 * Загрузить список продуктов
                 */
                axios.get('/api/v1/getProductList')
                    .then(response => {
                        this.productList = response.data;
                    });

            });

        }
    }
</script>
