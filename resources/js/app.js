require('./bootstrap');
window.Vue = require('vue');
import "bootstrap/dist/css/bootstrap.min.css";

import Vue from 'vue';
import VueRouter from 'vue-router';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import App from './components/App';

Vue.use(BootstrapVue);
Vue.use(VueRouter);

const axios = require('axios');

const routes = [
    { path: '/', component: App },
];

const router = new VueRouter({
    history: 'mode',
    routes,
});

const app = new Vue({
    el: "#app",
    components: {
        App,
    },
    router,
    BootstrapVue,
    IconsPlugin,
    axios,
});