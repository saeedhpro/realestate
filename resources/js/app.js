require('./bootstrap');
window.Vue = require('vue');

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    data(){
        return{
            showPhone: false,
            showEmail: false,
        }
    },
    methods: {
        showPhoneMethod(){
            this.showPhone = true;
            this.showEmail = false;
        },
        showEmailMethod(){
            this.showEmail = true;
            this.showPhone = false;
        },
    },
});
