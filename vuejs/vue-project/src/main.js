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

Vue.use(Vuelidate);

import VueRouter from 'vue-router';
import router from './routes'

Vue.use(VueRouter)
import VueResource from 'vue-resource'

Vue.use(VueResource);

Vue.http.options.root = 'http://localhost:3000/';    //объект конфигурации

Vue.http.interceptors.push(request => {
    request.headers.set('_token', 'RAND TOKEN' + Math.random());
})
*/
import store from './store'


new Vue({
    el: '#app',
    store: store,  //можно просто store
    render: h => h(App),
    //router
});


