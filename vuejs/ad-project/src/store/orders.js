import * as fb from 'firebase'

class Order {
    constructor (name, phone, adId, done = false, id =null) {
        this.name = name
        this.phone = phone
        this.adId = adId
        this.done = done
        this.id = id
    }
}

export default {
    state: {
        orders: []
    },
    mutations: {
        loadOrders (state, payload) {
            state.orders = payload
        }
        /*createOrder (state, payload) {
            state.orders.push(payload)
        }*/
    },
    actions: {
        async createOrder ({commit}, {name, phone, adId, ownerId}) {
            const order = new Order(name, phone, adId)
            commit('clearError')
            try {
                await fb.database().ref(`/users/${ownerId}/orders`).push(order)
            } catch (e) {
                commit('setError', e.message)
                throw e
            }
            /*await new Promise((resolve, reject) => {
                setTimeout(() => {
                    resolve()
                }, 4000)
            })*/
        },
        async fetchOrders ({commit, getters}) {
            commit('setLoading', true)
            commit('clearError')
            const resultOrders = []
            try {
                const fbVal = await fb.database().ref(`/users/${getters.user.id}/orders`).once('value')
                const orders = fbVal.val()
                Object.keys(orders).forEach(key => {
                    const o = orders[key]
                    resultOrders.push(
                        new Order(o.name, o.phone, o.adId, o.done, key)
                    )
                })
                commit('loadOrders', resultOrders)
                commit('setLoading', false)
            } catch (e) {
                commit('setLoading', false)
                commit('setError', e.message)
                throw  e
            }
        },
        async markOrderDone ({commit, getters}, payload) {
            try {
                await fb.database().ref(`/users/${getters.user.id}/orders`).child(payload).update({
                    done: true
                })
            } catch (e) {
                commit('setError', e.message)
                throw  e
            }
        }
    },
    getters: {
        doneOrders (state) {
            return state.orders.filter(o => o.done)
        },
        unDoneOrders (state) {
            return state.orders.filter(o => ! o.done)
        },
        orders (state, getters) {
            return getters.unDoneOrders.concat(getters.doneOrders)
        }
    }
}
