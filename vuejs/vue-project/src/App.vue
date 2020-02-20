<template>
    <div class="container">
        <!--<h1>Parent: {{carName}}</h1>

        <app-counter :counter="counter"></app-counter>
        <app-counter></app-counter>

        <app-car
                v-bind:carName="carName"
                :carYear="carYear"
                :counter="counter"
                :changeFunc = "changeNameToAudi"
                @nameChanged="carName = $event"
                @counterUpdated="counter = $event"
        ></app-car>
        <app-car
                v-bind:carName="carName"
                :carYear="carYear"
                :changeFunc = "changeNameToAudi"
                @nameChanged="carName = $event"
        ></app-car>
        <app-car></app-car>
        <app-car>
            <h2 slot="title">{{carName}}</h2>
            <p slot="text">Lorem ipsum dolor.</p>
        </app-car>
        <button @click="visible = !visible">Toggle</button>
        <button @click="title = 'new title'">Change Title</button>
        <h2 v-colored v-if="visible">{{title}}</h2>
        <h2 v-colored:background.font="'aquamarine'">{{title}}</h2>
        <h2 v-colored:color.delay.font="'blue'">{{title}}</h2>

        <h2 v-font>Local font directive</h2>


        <h2>{{title}}</h2>
        <h2>{{title | lowercase}}</h2>
        <h2>{{title | uppercase}}</h2>
        <h2>{{title | uppercase | lowercase}}</h2>
        <input type="text" v-model="searchName">
        <ul>
            <li v-for="name of names">{{name}}</li>
            <li v-for="name of filteredNames">{{name}}</li>
        </ul>
        <hr>
        <app-list></app-list>

        <h2>Form Inputs</h2>
        <input type="text" v-model.lazy="name">

        <p>{{name}}</p>

        <textarea v-model="textarea"></textarea>
        <p>{{textarea}}</p>

        <label>
            <input type="checkbox" value="instagram" v-model="social"> Instagram
        </label>
        <label>
            <input type="checkbox" value="vk" v-model="social"> Vk
        </label>
        <label>
            <input type="checkbox" value="facebook" v-model="social"> Facebook
        </label>

        <hr>
        <ul>
            <li v-for="s in social">{{s}}</li>
        </ul>

        <label>
            <input type="radio" value="instagram" v-model="social"> Instagram
        </label>
        <label>
            <input type="radio" value="vk" v-model="social"> Vk
        </label>
        <label>
            <input type="radio" value="facebook" v-model="social"> Facebook
        </label>

        <hr>
        <p>{{social}}</p>
        <select v-model="social">
            <option
                    v-for="social in socialsList"
                    v-bind:selected="social === defaultSocial"
            >{{social}}</option>
            <option
                    v-for="s in socialsList"
            >{{s}}</option>
        </select>
        <hr>
        <p>{{social}}</p>
        <input type="text" v-model.number="age">
        <p>{{age}}</p>
        <app-onoff v-model="switched"></app-onoff>

        <div>
            <h3 v-if="switched">Component is enabled</h3>
            <h3 v-else>Component is disabled</h3>
        </div>-->

        <!--<h1>bootstrap</h1>-->
        <form class="pt-3" @submit.prevent="onSubmit">
            <div class="form-group">
                <label for="email">Email</label>
                <input
                        type="text"
                        class="form-control"
                        :class="{'is-invalid': $v.email.$error}"
                        id="email"
                        @blur="$v.email.$touch()"
                        v-model="email"
                >
                <div class="invalid-feedback" v-if="!$v.email.required">Email field is required</div>
                <div class="invalid-feedback" v-if="!$v.email.email">This field should be an email</div>
                <div class="invalid-feedback" v-if="!$v.email.uniqueEmail">This email is already exists</div>
            </div>
<!--            <pre>{{$v.email}}</pre>-->

            <div class="form-group">
                <label for="password">Password</label>
                <input
                        type="password"
                        class="form-control"
                        :class="{'is-invalid': $v.password.$error}"
                        id="password"
                        @blur="$v.password.$touch()"
                        v-model="password"
                >
                <div class="invalid-feedback" v-if="!$v.password.minLength">
                    Min length of password is {{$v.password.$params.minLength.min}}. Now it is {{password.length}}
                </div>

            </div>

            <div class="form-group">
                <label for="confirm">Confirm password</label>
                <input
                        type="password"
                        class="form-control"
                        :class="{'is-invalid': $v.confirmPassword.$error}"
                        id="confirm"
                        @blur="$v.confirmPassword.$touch()"
                        v-model="confirmPassword"
                >
                <div class="invalid-feedback" v-if="!$v.confirmPassword.sameAs">
                    Passwords should match
                </div>

            </div>

            <button
                    class="btn btn-success"
                    type="submit"
                    :disabled="$v.$invalid"
            >Submit</button>
        </form>
    </div>

</template>

<script>

    // import Car from './Car.vue';
    //import Counter from './Counter.vue';

    // import listMixin from "./listMixin";
    // import Onoff from "./Onoff";
    import { required, email, minLength, sameAs } from 'vuelidate/lib/validators'

    export default {
        methods: {
          /*changeNameToAudi() {
              this.carName = 'Audi';
          }*/
            onSubmit() {
                console.log('Email', this.email);
                console.log('Password', this.password);
                this.email = '';
                this.password = '';
                this.confirmPassword = '';
            }
        },
        name: 'app',
        data() {
            return {
                //msg: 'Welcome   sss'
                //carName: 'Ford',
                // carName: 1000,
                // carYear: 2010,
                // visible: true,
                // counter: 0
                //title: 'Hello I am Vue!',
                // names: ['Vlad', 'Max', 'Elena', "igor"],
                // searchName: ''
                //name: 'Initial satate'
                //textarea: 'I am initial text'
                // social: ['vk']
                // social: 'facebook'
                // socialsList: ['instagram', 'vk', 'facebook'],
                // social: 'instagram',
                // defaultSocial: 'vk',
                // age: 20
                // switched: true
                form: {
                    password: ''
                },
                email: '',
                password: '',
                confirmPassword: '',
            }
        },
        watch: {
            /*age(val) {
                console.log(val);
                console.log(typeof val);
            }*/
        },
        components: {
            //appCar: Car,
            //appCounter: Counter
            // appOnoff: Onoff
        },
        /*directives: {
            font: {
                bind(el, bindings, vnode) {
                    el.style.fontSize = '40px';
                }
            }
        }
        filters: {
            lowercase(value) {
                return value.toLowerCase();
            }
        },*/
        computed: {
            /*filteredNames() {
                return this.names.filter(name => {
                    return name.toLowerCase().indexOf(this.searchName.toLowerCase()) !== -1;
                });
            }*/
        },
        validations: {
            email: {
                required,  //для ES6 можно совпадающие значения не указывать
                email,
                uniqueEmail: function (newEmail) {
                    // return newEmail !== 'test@mail.ru';
                    if (newEmail === '') return true;
                    return new Promise((resolve, reject) => {
                        setTimeout(()=>{
                            const value = newEmail !== 'test@mail.ru';
                            resolve(value);
                        }, 3000);
                    });
                }
            },
            password: {
                minLength: minLength(6)
            },
            confirmPassword: {
                /*sameAs: sameAs((vue) => {
                    // return vue.form.password;
                    return vue.password;
                })*/
                sameAs: sameAs('password')
            }
        }
        //mixins: [listMixin]
    }
</script>

<style scoped>
    /*#app {
      font-family: 'Avenir', Helvetica, Arial, sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      text-align: center;
      color: #2c3e50;
      margin-top: 60px;
    }

    h1, h2 {
      font-weight: normal;
    }

    ul {
      list-style-type: none;
      padding: 0;
    }

    li {
      display: inline-block;
      margin: 0 10px;
    }

    a {
      color: #42b983;
    }
        h2 {
            color: red;
        }
    textarea {
        width: 400px;
        height: 100px;
    }

    p {
        white-space: pre;
    }*/
</style>
