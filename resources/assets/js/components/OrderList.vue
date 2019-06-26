<template>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">название партнера</th>
                    <th scope="col">стоимость заказа</th>
                    <th scope="col">наименование состав заказа</th>
                    <th scope="col">статус заказа</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in listOrder.data">
                    <td scope="row">
                        <router-link :to="'/editOrder/'+item.id">
                            {{item.id}}
                        </router-link>
                    </td>
                    <td>{{item.partner.name}}</td>
                    <td>{{getSum(item.product)}}</td>
                    <td>{{getProduct(item.product)}}</td>
                    <td>{{getStatus(item.status)}}</td>
                </tr>
            </tbody>
        </table>

    </div>

</template>

<script>
    import Paginate from "laravel-vue-pagination";

    export default {
        components: {Paginate},
        name: "listOrder",
        props: ['listOrder'],
        computed: {

        },
        methods: {
            /**
             * Вывести читаемое название статуса
             *
             * @param status
             * @return {string}
             */
            getStatus: function (status) {
                let arStatus = {
                    0: 'новый',
                    10: 'подтвержден',
                    20: 'завершен',
                };
                return arStatus[status];
            },
            /**
             * Вывести сумму
             *
             * @param products <array>
             * @return {number}
             */
            getSum: function (products) {
                let sum = 0;
                products.forEach(function(element) {
                    sum+= element.pivot.price * element.pivot.quantity;
                });
                return sum;
            },
            /**
             * Вывести список продуктов
             *
             * @param products
             * @return {string}
             */
            getProduct(products) {
                let productsList = '';
                products.forEach(function(element, index) {
                    productsList = productsList + element.name;
                    if(index < products.length) {
                        productsList = productsList + ',';
                    }
                });
                return productsList;
            },
        }
    }
</script>

<style scoped>

</style>