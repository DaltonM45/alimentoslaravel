
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//MOMENTS JS
//Vue.use(require('vue-moment'));
import moment from 'moment';
moment.locale('es');

Vue.filter('formatlocale', (value) => {
    return moment(value).format('LLL');
})


//ROUTES
import router from './router'







Vue.component('food-component', require('./components/FoodComponent.vue').default);
Vue.component('estadistica-component', require('./components/Estadistica.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
