import Vue from 'vue'
import VueRouter from 'vue-router';

import OrderTabs from './components/OrderTabs.vue';
import EditOrder from './components/EditOrder.vue';



Vue.use(VueRouter);

Vue.component('OrderTabs', OrderTabs);
Vue.component('EditOrder', EditOrder);

const ROOT_URL = '/';

let routes = [
    {
        path: ROOT_URL,
        component: OrderTabs,
        name: 'root'
    },
    {
        path: '/editOrder',
        component: EditOrder,
        name: 'EditOrder'
    }
];


const router = new VueRouter({
    mode: 'history',
    routes: routes,
});

export default router;
