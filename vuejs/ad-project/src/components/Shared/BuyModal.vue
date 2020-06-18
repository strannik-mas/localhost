<template>
    <v-dialog
            width="400px"
            v-model="modal"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                    class="primary"
                    text
                    v-bind="attrs"
                    v-on="on"
            >Buy
            </v-btn>
        </template>
        <v-card>
            <v-container>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-title>
                            <h1 class="text-primary">Do you want to buy it?</h1>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-text>
                            <v-text-field
                                    label="Name"
                                    name="name"
                                    type="text"
                                    v-model="name"
                            />
                            <v-text-field
                                    label="Phone"
                                    name="phone"
                                    type="text"
                                    v-model="phone"
                            />
                        </v-card-text>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-actions>
                            <v-spacer>
                                <v-btn text @click="onCancel" :disabled="localLoading">Close</v-btn>
                                <v-btn text class="success" @click="onSave" :disabled="localLoading" :loading="localLoading">Buy it!</v-btn>
                            </v-spacer>
                        </v-card-actions>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        props: ['ad'],
        data () {
            return {
                modal: false,
                name: "",
                phone: "",
                localLoading: false
            }
        },
        methods: {
            onSave () {
                if (this.name !== '' && this.phone !== '') {
                    this.localLoading = true
                    this.$store.dispatch('createOrder', {
                        name: this.name,
                        phone: this.phone,
                        adId: this.ad.id,
                        ownerId: this.ad.ownerId
                    }).finally(() => {
                        this.name = ""
                        this.phone = ""
                        this.localLoading = false
                        this.modal = false
                    })

                }
            },
            onCancel () {
                this.name = ""
                this.phone = ""
                this.modal = false
            }
        }
    }
</script>

<style scoped>

</style>
