require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'
import vSelect from 'vue-select'

Vue.component('v-select', vSelect);
import vue2Dropzone from 'vue2-dropzone'

import ToggleSwitch from 'vuejs-toggle-switch'

Vue.component("dropzone", vue2Dropzone);
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    mounted(){
        if($("#let").length>0)this.loadET();
    },
    data(){
        return{
            showPhone: false,
            showEmail: false,

            //
            estate_types: [],
            sell_types: [{id: 1, label: 'برای فروش'},{id: 2, label: 'برای رهن و اجاره'}],
            // Escrow Advertise

            userName: null,
            userPhone: null,
            estateType: null,
            sellType: null,
            advTitle: null,
            area: null,
            room: null,
            age: null,
            description: null,
            images: [],
            address: null,
            props: [],
            needVrTour: false,

            state_id: null,
            city_id: null,
            states: [],
            cities: [],



            // End Escrow Advertise

            dropzoneSingleOptions: {
                url: '/upload',
                maxFiles: 1,
                maxFileSize: 150,
                thumbnailWidth: 150, // px
                thumbnailHeight: 150,
                addRemoveLinks: true,
            },
        }
    },
    methods: {
        loadET(){
            axios.get('/api/estate-types')
                .then((response)=>{
                    // this.estate_types = response.data;
                    response.data.forEach((item)=>{
                        this.estate_types.push({
                            id: item.id,
                            label: item.title
                        });
                    });
                })
                .catch((e)=>{})
        },
        dropzoneSingleAfterComplete(file){

        },

        showPhoneMethod(){
            this.showPhone = true;
            this.showEmail = false;
        },
        showEmailMethod(){
            this.showEmail = true;
            this.showPhone = false;
        },
        loadCities(){
            axios.get('/states/'+this.state_id+'/cities')
                .then((response)=>{
                    console.log(response);
                })
        },
        escrowAdv(){
            let userName = this.userName;
            let userPhone = this.userPhone;
            let estateType = this.estateType;
            let sellType = this.sellType;
            let advTitle = this.advTitle;
            let area = this.area;
            let room = this.room;
            let age = this.age;
            let description = this.description;
            let images = this.images;
            let address = this.address;
            let lat = $('#lat').val();
            let lng = $('#lng').val();
            let props = this.props;
            let needVrTour = this.needVrTour;
            let state_id = 30;
            let city_id = 1225;
            axios.post('/escrow', {
                name: userName,
                phone: userPhone,
                estate_type_id:  estateType,
                sellType: sellType,
                advTitle: advTitle,
                area: area,
                room: room,
                age: age,
                description: description,
                images: images,
                address: address,
                lat: lat,
                lng: lng,
                props: props,
                needVrTour: needVrTour,
                state_id: state_id,
                city_id: city_id
            })
                .then((response)=>{
                    console.log(response)
                })
                .catch((error)=>{});
        },

    },
});
