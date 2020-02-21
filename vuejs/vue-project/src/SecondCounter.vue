<template>
    <div>
        <h2>Second Counter {{counter}}</h2>
    </div>
</template>

<script>
    export default {
        computed: {
            counter(){
                // return this.$store.state.counter * (7-2*(5+4));
                return this.$store.getters.computedCounter;
            }
        }
    }
</script>

<style scoped>
</style>