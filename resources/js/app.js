import './bootstrap';

import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import store from './store';

import Clients from './components/Clients.vue';
import VButton from './components/Button.vue';
import AddClientModal from './components/AddClientModal.vue';
import AddProjectModal from './components/AddProjectModal';
import AddPaymentModal from './components/AddPaymentModal';
import { sync } from 'vuex-router-sync';

const router =  new VueRouter(routes);

Vue.use(VueRouter);

sync(store, router);

Vue.filter('price', function (value) {
    if (!value) return 0;
    return (value / 100).toFixed(2);
});

Vue.filter('date', function (value) {
    let d = new Date(value);
    return d.toDateString()
});

const app = new Vue({
    el: "#app",

    store,
    router,

    components: {
        Clients,
        VButton,
        AddClientModal,
        AddProjectModal,
        AddPaymentModal,
    },
})
