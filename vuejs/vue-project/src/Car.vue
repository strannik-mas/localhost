<template>
    <!--<div class="car">
        <h3>Name: {{carName}}\{{reverseName}}</h3>
        <p>Year: {{carYear}}</p>
        <button @click="changeName">Change name</button>
        <button @click="changeFunc()">Change Audi</button>
        <button @click="updateCounter">Update Counter</button>
    </div>
    <div>
        <h2>Car</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, nemo.</p>
    </div>-->
    <div>
        <slot name="title"></slot>
        <hr>
        <hr>
        <slot name="text"></slot>
    </div>
</template>

<script>
    //import {eventEmitter} from "./main";

    export default {
        /*props: ['carName', 'carYear'],
        props: {
            carName: String,
            carYear: Number
        },
        props: {
            carName: {
                type: String,
                required: true,
                //default: 'Def name'
            },
            carYear: Number,
            //counter: Number,
            changeFunc: Function
        },
        computed: {
            reverseName() {
                return this.carName.split('').reverse().join('');
            }
        },
        methods: {
            changeName() {
                this.carName = "Mazda";
                this.$emit('nameChanged', this.carName);
            },
            updateCounter() {
                //console.log(this.counter);
                //this.$emit('counterUpdated', this.counter + 1)
                eventEmitter.$emit('counterUpdated', 3);
            }
        }
        data() {
            return {
                //carName: 'Ford',
                carYear: 2015
            }
        }*/
    }
</script>

<style scoped>
    /*.car {
        border: 1px solid #000;

    }
    .car h3{
        color: red;
    }*/
    
    div {
        border: 1px solid #000;
        padding: 10px;
    }

    h2 {
        color: red;
    }
</style>