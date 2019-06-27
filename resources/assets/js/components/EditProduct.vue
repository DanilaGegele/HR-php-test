<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Список продуктов
                    </div>

                    <div class="panel-body">
                        <b v-if="message"> {{message}}</b>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Названия продукта</th>
                                    <th scope="col">Названия поставщика</th>
                                    <th scope="col">Цена</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in listProduct.data">
                                    <td scope="row">{{item.id}}</td>
                                    <td>{{item.name}}</td>
                                    <td>{{item.vendor.name}}</td>
                                    <td><input v-model="item.price" class="form-control" type="number"></td>
                                    <td><b @click="updateProduct(item)">Сохронить</b></td>
                                </tr>
                                </tbody>
                            </table>


                            <Paginate
                                    :data="listProduct"
                                    @pagination-change-page="getLoadProductList"></Paginate>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    import Paginate from "laravel-vue-pagination";

    export default {
        components: {
            Paginate
        },
        name: "edit-product",
        data() {
            return {
                listProduct: {},
                message: '',
            };
        },
        methods: {
            /**
             * Загрузить список продуктов
             *
             * @param page
             */
            getLoadProductList: function (page = 1) {
                let app = this;
                axios.get('/api/v1/getProductList?page=' + page)
                    .then(response => {
                        this.listProduct = response.data;
                    });
            },

            updateProduct: function (item) {
                let app = this;
                axios.post('/api/v1/updateProduct/' + item.id,{
                    price:  item.price
                })
                    .then(response => {
                        this.message = 'Цена у продукта ' + item.name + ' обновлена!';
                        let app = this;
                        setTimeout(function () {
                            app.message = '';
                        }, 3000);
                    });
            },

        },
        mounted() {
            this.$nextTick(function () {
                /**
                 * Загрузить данные по определённому заказу
                 */
                this.getLoadProductList();
            });

        }
    }
</script>

<style scoped>

</style>