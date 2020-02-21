import Vue from "vue";
import Vuex from "vuex";
import counter from "./counter";

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        // counter: 0
        title: "hello from store"
    },
    getters: {
        // computedCounter(state){
        //     return state.counter * 10
        // }
        title(state) {
            return state.title + "!!!"
        }
    },
    /*mutations: {
        changeCounter(state, payload){
            state.counter += payload;
        }
    },
    actions: {
        asyncChangeCounter(context, payload) {
            setTimeout(() => {
                context.commit('changeCounter', payload)
            }, 2000);
        }

        asyncChangeCounter({commit}, payload) {
            setTimeout(() => {
                commit('changeCounter', payload.counterValue)
            }, payload.timeout);
        }
    }*/
    modules: {
        counter
    }
})