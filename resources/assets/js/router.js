import Vue from 'vue'
import VueRouter from 'vue-router';

import OrderTabs from './components/OrderTabs.vue';
import EditOrder from './components/EditOrder.vue';
import EditProduct from './components/EditProduct.vue';


Vue.use(VueRouter);

Vue.component('OrderTabs', OrderTabs);
Vue.component('EditOrder', EditOrder);
Vue.component('EditProduct', EditProduct);

let routes = [
    {
        path: '/',
        component: OrderTabs,
        name: 'root'
    },
    {
        path: '/editOrder/:id',
        component: EditOrder,
        name: 'EditOrder'
    },
    {
        path: '/editProduct',
        component: EditProduct,
        name: 'EditProduct'
    }
];


const router = new VueRouter({
    mode: 'history',
    routes: routes,
});

export default router;
