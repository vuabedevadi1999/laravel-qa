require('./bootstrap');

require('./fontawesome');
import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.css';
window.Vue = require('vue').default;
import Authorization from './authorization/authorize';
import Vue from 'vue';
Vue.use(VueIziToast);
Vue.use(Authorization);
Vue.component('user-info', require('./components/UserInfo.vue').default);
Vue.component('answer', require('./components/Answer.vue').default);
Vue.component('vote', require('./components/Vote.vue').default);

const app = new Vue({
    el: '#app',
});
