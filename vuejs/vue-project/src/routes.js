import VueRouter from 'vue-router'
import Home from './pages/Home'
//import Cars from './pages/Cars';
//import Car from './pages/Car';
import CarFull from './pages/CarFull';
import ErrorCmp from './pages/Error';

const Cars = resolve => {
    require.ensure(['./pages/Cars.vue'], ()=>{
        resolve(
            require('./pages/Cars.vue')
        )
    })
}

const Car = resolve => {
    require.ensure(['./pages/Car.vue'], ()=>{
        resolve(
            require('./pages/Car.vue')
        )
    })
}

export default new VueRouter({
    routes: [
        {
            path: '',       //localhost:8080
            component: Home
        },
        {
            path: '/cars',       //localhost:8080
            component: Cars,
            name: 'cars'
        },
        {
            path: '/car/:id',
            component: Car,
            children: [
                {
                    path: 'full',   //localhost:8080/car/4/full
                    component: CarFull,
                    name: 'carFull',
                    beforeEnter(to, from, next) {
                        console.log('beforeEnter')
                        /*if (true){
                            next(true)
                        }else {
                            next(false)
                        }*/
                        next();
                    }
                }
            ]
        },
        {
            path: '/none',
            // redirect: '/'
            redirect: {
                name: 'cars'
            }
        },
        {
            path: '*',
            component: ErrorCmp
        }
    ],
    mode: 'history',
    scrollBehavior(to, from, savedPosition){
        if (savedPosition) {
            return savedPosition
        }

        if (to.hash) {
            return {selector: to.hash}
        }
        return {
            x: 0,
            y: 500
        }
    }
});