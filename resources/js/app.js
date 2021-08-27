require('./bootstrap');

require('./fontawesome');
import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.css';
window.Vue = require('vue').default;
Vue.use(VueIziToast);
Vue.component('user-info', require('./components/UserInfo.vue').default);
Vue.component('answer', require('./components/Answer.vue').default);


const app = new Vue({
    el: '#app',
});
