import Vue from 'vue';
import App from './App.vue';
/*import Vuelidate from 'vuelidate';
import ColorDirective from './color'
// import List from "./List";
//import Car from './Car.vue'

//Vue.component('app-car', Car);
//export const eventEmitter = new Vue();

Vue.directive('colored', ColorDirective);

Vue.filter('uppercase', value => value.toUpperCase());

Vue.component('app-list', List);

Vue.mixin({
    beforeCreate() {
        console.log('beforeCreate')
    }
});

Vue.use(Vuelidate);*/

import VueRouter from 'vue-router';
import router from './routes'

Vue.use(VueRouter)

new Vue({
    el: '#app',
    render: h => h(App),
    router
});


