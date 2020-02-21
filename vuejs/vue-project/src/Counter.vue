<template>
    <!--<h1>Counter: {{counter}}</h1>-->
    <div>
        <h2>Counter {{counter}}</h2>
<!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, nemo.</p>-->
    </div>
</template>

<script>
//import {eventEmitter} from "./main";

export default {
    /*props: ['counter']
    data() {
        return {
            counter: 0
        }
    },
    created() {
        eventEmitter.$on('counterUpdated', (num) => {
            this.counter += num;
        })
    }*/
    computed: {
        counter(){
            // return this.$store.state.counter * (7-2*(5+4));
            return this.$store.getters.computedCounter;
        }
    }
}
</script>

<style scoped>
    /*h2 {
        color: red;
    }*/
</style>