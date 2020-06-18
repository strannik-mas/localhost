import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'
import vuetify from '@/plugins/vuetify'
import BuyModalComponent from '@/components/Shared/BuyModal'
import * as fb from 'firebase'
//import './stylus/main.styl'

Vue.component('app-buy-modal', BuyModalComponent)
Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    vuetify,
    store,
    components: {App},
    template: '<App/>',
    created() {
        var firebaseConfig = {
            apiKey: "AIzaSyCb5QHpMg7iUSJL4AYZCe0mBDzyLXzG4CY",
            authDomain: "ads-project-6c497.firebaseapp.com",
            databaseURL: "https://ads-project-6c497.firebaseio.com",
            projectId: "ads-project-6c497",
            storageBucket: "ads-project-6c497.appspot.com",
            messagingSenderId: "345988446570",
            appId: "1:345988446570:web:57fc4c09ae110ed72f0d13"
        };

        // Initialize Firebase
        fb.initializeApp(firebaseConfig);

        //для того, чтобы не сбрасывалась авторизация при перезагрузке
        fb.auth().onAuthStateChanged(user => {
            if (user) {
                this.$store.dispatch('autoLoginUser', user)
            }
        })

        this.$store.dispatch('fetchAds')
    }
})
