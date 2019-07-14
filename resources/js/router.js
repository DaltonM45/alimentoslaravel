import Vue from 'vue'
import Router from 'vue-router'

//componentes.

import Food from './components/FoodComponent'
import Estadistica from './components/Estadistica'


Vue.use(Router);

export default  new Router({

    routes : [

        {
            path: '/',
            name : 'food',
            component : Food
        },
        {
            path: '/estadisticas',
            name: 'estadisticas',
            component : Estadistica
        },

       

    ],

    mode: 'history'


})

