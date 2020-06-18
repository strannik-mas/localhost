<template>
    <v-dialog
            width="400px"
            v-model="modal"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                    class="warning"
                    text
                    v-bind="attrs"
                    v-on="on"
            >Edit
            </v-btn>
        </template>
        <v-card>
            <v-container>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-title>
                            <h1 class="text-primary">Edit ad</h1>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-text>
                            <v-text-field
                                    label="Title"
                                    name="title"
                                    type="text"
                                    v-model="editedTitle"
                            />
                            <v-text-field
                                    label="Description"
                                    name="description"
                                    type="text"
                                    aria-multiline="true"
                                    v-model="editedDescription"
                            />
                        </v-card-text>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-actions>
                            <v-spacer>
                                <v-btn text @click="onCancel">Cancel</v-btn>
                                <v-btn text class="success" @click="onSave">Save</v-btn>
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
                editedTitle: this.ad.title,
                editedDescription: this.ad.description
            }
        },
        methods: {
            onSave () {
                if (this.editedDescription !== '' && this.editedTitle !== '') {
                    this.$store.dispatch('updateAd', {
                        title: this.editedTitle,
                        description: this.editedDescription,
                        id: this.ad.id
                    })
                    this.modal = false
                }
            },
            onCancel () {
                this.editedTitle = this.ad.title
                this.editedDescription = this.ad.description
                this.modal = false
            }
        }
    }
</script>

<style scoped>

</style>
