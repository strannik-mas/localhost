<template>
    <v-container>
        <v-layout row>
            <v-flex xs12 class="text-xs-center pt-5" v-if="loading">
                <v-progress-circular
                        :size="100"
                        :width="4"
                        indeterminate
                        color="purple"
                />
            </v-flex>
            <v-flex xs12 sm6 offset-sm3 v-else-if="!loading && orders.length !==0">
                <h1 class="text--secondary mb-3">Orders</h1>
                <v-list
                        subheader
                        two-line
                >

                    <v-list-item-group
                            multiple
                    >
                        <v-list-item
                                v-for="order in orders"
                                :key="order.id"
                        >
                            <template v-slot:default="{ active, toggle }">
                                <v-list-item-action>
                                    <!--<v-checkbox
                                            color="primary"
                                            @click="toggle"
                                    ></v-checkbox>-->
                                    <v-checkbox
                                            color="success"
                                            :input-value="order.done"
                                            @change="markDone(order)"
                                    ></v-checkbox>
                                </v-list-item-action>

                                <v-list-item-content>
                                    <v-list-item-title>{{order.name}}</v-list-item-title>
                                    <v-list-item-subtitle>{{order.phone}}</v-list-item-subtitle>
                                </v-list-item-content>

                                <v-list-item-action>
                                    <v-btn
                                            class="primary"
                                            :to="'/ad/' + order.adId"
                                    >Open</v-btn>
                                </v-list-item-action>
                            </template>
                        </v-list-item>
                    </v-list-item-group>
                </v-list>
            </v-flex>
            <v-flex xs12 class="text-xs-center" v-else>
                <h1 class="text--secondary">No oders</h1>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        /*data(){
            return {
                orders: [
                    {
                        id: 'f24s',
                        name: 'Alex',
                        phone: '8-521-55-66-444',
                        adId: '123',
                        done: false
                    }
                ]
            }
        },*/
        computed: {
            loading() {
                return this.$store.getters.loading
            },
            orders () {
                return this.$store.getters.orders
            }
        },
        methods: {
            markDone (order) {
                this.$store.dispatch('markOrderDone', order.id)
                    .then(() => {
                        order.done = true;
                    })
                    .catch(() => {})

            }
        },
        created () {
            this.$store.dispatch('fetchOrders')
        }
    }
</script>

<style scoped>

</style>
