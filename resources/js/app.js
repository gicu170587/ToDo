
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';

import {routes} from './routes.js';
import storeData from './store.js'; //store auth user data
import MainApp from './components/MainApp.vue';
import Vuelidate from 'vuelidate';
import { BootstrapVue,  BIconTrash, BIconPlusSquare, BIconPencilSquare } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue) //bootstrap
Vue.component('BIconTrash', BIconTrash) //delete icon
Vue.component('BIconPlusSquare', BIconPlusSquare) //add icon
Vue.component('BIconPencilSquare', BIconPencilSquare) //edit icon

Vue.use(Vuelidate)
Vue.use(VueRouter);
Vue.use(Vuex);

const router = new VueRouter({
    routes,
    mode: 'history'
});

const store = new Vuex.Store(storeData);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp,
    }
});