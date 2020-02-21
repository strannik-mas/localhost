export default {
    state: {
        counter: 0
    },
    mutations: {
        changeCounter(state, payload){
            state.counter += payload;
        }
    },
    actions: {
        asyncChangeCounter({commit}, payload) {
            setTimeout(() => {
                commit('changeCounter', payload.counterValue)
            }, payload.timeout);
        }
    },
    getters: {
        computedCounter(state){
            return state.counter * 10
        }
    },
}