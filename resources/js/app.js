require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

// Router imported
import {routes} from './routes'; 

// Import Helper User Class to be use as GLOBALLY
import User from './Helpers/User';
window.User = User;

// [START] Import SweetAlert GLOBALLY
import Swal from 'sweetalert2';
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.Toast = Toast;
// [END] Import SweetAlert GLOBALLY

// initiate router
const router = new VueRouter({
    routes
})

const app = new Vue({
    el: '#app',
    router
});
