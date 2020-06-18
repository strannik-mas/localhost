<template>
    <div v-if="!loading">
        <v-container fluid>
            <v-layout row>
                <v-flex xs12>
                    <v-carousel>
                        <v-carousel-item
                                v-for="(ad) in promoAds"
                                :key="ad.id"
                                :src="ad.imageSrc"
                                reverse-transition="fade-transition"
                                transition="fade-transition"
                        >
                            <div class="car-link">
                                <v-btn class="error" :to="'/ad/' + ad.id">{{ad.title}}</v-btn>
                            </div>
                        </v-carousel-item>
                    </v-carousel>
                </v-flex>
            </v-layout>
        </v-container>
        <v-container
                grid-list-lg
        >
            <v-layout row wrap>
                <v-flex
                        xs12
                        sm6
                        md4
                        v-for="ad of ads"
                        :key="ad.id"
                >
                    <v-card
                            class="mx-auto"
                            max-width="400"
                    >
                        <v-img
                                class="white--text align-end"
                                height="200px"
                                :src="ad.imageSrc"
                        >
                            <!--<v-card-title>Top 10 Australian beaches</v-card-title>-->
                        </v-img>

                        <v-card-title>{{ad.title}}</v-card-title>
                        <!--<v-card-subtitle class="pb-0">Number 10</v-card-subtitle>-->

                        <v-card-text class="text--primary">
                            <div>{{ad.description}}</div>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer/>
                            <v-btn
                                    text
                                    :to="'/ad/' + ad.id"
                            >
                                Open
                            </v-btn>

                            <app-buy-modal :ad="ad"></app-buy-modal>
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
    <div v-else>
        <v-container>
            <v-layout row>
                <v-flex xs12 class="text-xs-center pt-5">
                    <v-progress-circular
                            :size="100"
                            :width="4"
                            indeterminate
                            color="purple"
                    />
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        computed: {
            promoAds() {
                return this.$store.getters.promoAds
            },
            ads(){
                return this.$store.getters.ads
            },
            loading () {
                return this.$store.getters.loading
            }
        }
    }
</script>

<style scoped>
    .car-link {
        position: absolute;
        bottom: 50px;
        left: 50%;
        background-color: rgba(0, 0, 0, .5);
        -webkit-transform: translate(-50%, 0);
        -moz-transform: translate(-50%, 0);
        -ms-transform: translate(-50%, 0);
        -o-transform: translate(-50%, 0);
        transform: translate(-50%, 0);
        padding: 5px 15px;
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
    }
</style>
