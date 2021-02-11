require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

// Router imported
import {routes} from './routes'; 

// Import User Class
import User from './Helpers/User';
window.User = User;

// initiate router
const router = new VueRouter({
    routes
})

const app = new Vue({
    el: '#app',
    router
});
