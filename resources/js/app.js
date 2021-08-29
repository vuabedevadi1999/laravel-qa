require('./bootstrap');

require('./fontawesome');
import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.css';
window.Vue = require('vue').default;
import Authorization from './authorization/authorize';
import Vue from 'vue';
Vue.use(VueIziToast);
Vue.use(Authorization);

Vue.component('question-page', require('./pages/QuestionPage.vue').default);
const app = new Vue({
    el: '#app',
});
