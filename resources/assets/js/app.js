
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./fontawesome');

window.Vue = require('vue');

import VueIzıToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.min.css';

Vue.use(VueIzıToast);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('user-info', require('./components/UserInfo'));
Vue.component('answer', require('./components/Answer'));
Vue.component('favorite', require('./components/Favorite'));
Vue.component('accept', require('./components/Accept'));

const app = new Vue({
    el: '#app'
});
