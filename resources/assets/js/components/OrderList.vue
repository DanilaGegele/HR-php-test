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
                    <th scope="row">{{item.id}}</th>
                    <td>{{item.name_partner}}</td>
                    <td>{{item.sum}}</td>
                    <td>{{item.products}}</td>
                    <td>{{getStatus(item.status)}}</td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        name: "fulfilled",
        props: ['listOrder'],
        methods: {
            getStatus: function (status) {
                let arStatus = {
                    0: 'новый',
                    10: 'подтвержден',
                    20: 'завершен',
                };
                return arStatus[status];
            }
        }
    }
</script>

<style scoped>

</style>