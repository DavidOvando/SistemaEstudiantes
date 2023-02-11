import './bootstrap';
require('./bootstrap');

//import vue from 'vue';
window.vue = vue;

import  App  from './components/App.vue';

//importamos axioz
import VueAxios from 'vue-axios';
import axios from 'axios';


// importamos y configuramos el vue router
import  VueRouter  from 'vue-router';
import { routes } from './routes';
import vue from 'vue';
vue.use(VueRouter);
vue.use(VueAxios, axios);

const router = new VueRouter(
    {
        mode:'history',
        routes: routes

    });

    const app = new vue({
        el: '#app',
        router: router,
        render: h => h(App),
    });
    



