
require('./bootstrap');

window.Vue = require('vue');

Vue.component('productos', require('./components/ProductoComponent.vue').default);
Vue.component('form-productos', require('./components/Views/FormProductoComponent.vue').default);
Vue.component('producto-productos', require('./components/Views/ProductoComponent.vue').default);


// maps

Vue.component('maps-component', require('./components/MapsGoogleComponent.vue').default);
Vue.component('kardex', require('./components/KardexComponent.vue').default);

import store from './store';

const app = new Vue({
    el: '#app',
    store,
    data (){
        return {
            menu:0,
        }
    },
    created(){
            this.$store.commit('SET_URL', $('#Base_Url').val())
       },
    methods: {
       
    },
    mounted: function () {
        Metro.init();
    }
});
