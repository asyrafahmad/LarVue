require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

import {routes} from './routes';                                       //import router

// initiate router
const router = new VueRouter({
    routes
})

const app = new Vue({
    el: '#app',
    router
});
