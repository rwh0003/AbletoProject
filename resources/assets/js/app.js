// Bootstrap JS
require('./bootstrap');

// Highcharts JS
import VueHighcharts from 'vue-highcharts';

// Vue and Vue components
window.Vue = require('vue');

Vue.use(VueHighcharts);
Vue.component('questionnaire', require('./components/Questionnaire.vue'));
Vue.component('question-module', require('./components/QuestionModule.vue'));

const app = new Vue({
    el: '#app'
});
