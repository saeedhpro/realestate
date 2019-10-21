require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'
import vSelect from 'vue-select'
import VueTelInput from 'vue-tel-input'
import vue2Dropzone from 'vue2-dropzone'

Vue.component('v-select', vSelect);

Vue.component("dropzone", vue2Dropzone);
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    mounted(){
        if($("#let").length>0)this.loadET();
    },
    components:{
        VueTelInput
    },
    data(){
        return{
            chks: [],
            showPhone: false,
            showEmail: false,
            //
            // Register
            name: null,
            email: null,
            password: null,
            repeat_password: null,
            phone: null,
            robot_check: false,
            agree_check: false,
            truephone: false,
            rememberme: false,
            user_error: null,
            email_error: null,
            password_error: null,
            //

            state_id: null,
            city_id: null,
            states: [],
            cities: [],

            //
            title: null,
            want_vr_tour: false,
            estate_type_id: null,
            advertise_type: null,
            area: null,
            rooms: 0,
            age: null,
            description: null,
            address: null,
            lat: null,
            lng: null,
            props: [],
            images: [],



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
        login(){
            this.email_error = null;
            this.password_error = null;
            this.user_error = null;
            const urlParams = new URLSearchParams(window.location.search);
            const url = urlParams.get('next');
            window.axios.default.post('/login', {
                email: this.email,
                password: this.password,
                rememberme: this.rememberme,
                url: url
            })
                .then((response)=>{
                    window.location.replace(response.data.url);
                })
                .catch((error)=>{
                    if(error.response.data.errors.email){
                        this.email_error = error.response.data.errors.email[0];
                    }
                    if(error.response.data.errors.password) {
                        this.password_error = error.response.data.errors.password[0];
                    }
                    if(error.response.data.errors.user){
                        this.user_error = error.response.data.errors.user;
                    }
                })

        },
        register(){

            window.axios.default.post('/register', {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.repeat_password,
                phone: this.phone,
            })
                .then((response) => {
                    window.localtion.replace('/');
                })
                .catch((error) => {console.log(error.response)})
        },
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
        storeAdvertise(){
            let estate_type_id = $("#estate_type_id").val();
            let advertise_type = $("#advertise_type").val();
            let title = this.title;
            let area = this.area;
            let room = this.room;
            let age = $("#age").val();
            let description = this.description;
            let tmps = $(".dropzone-images");
            let images = [];
            console.log(tmps);
            $.each(tmps, (index, item)=>{
                console.log(item.val());
            });
            console.log('end!', images);
            return;
            let address = this.address;
            let lat = $('#lat').val();
            let lng = $('#lng').val();
            let props = this.props;
            let want_vr_tour = this.want_vr_tour;
            let state_id = 30;
            let city_id = 1225;
            axios.default.post('/dashboard/advertise', {
                estate_type_id:  estate_type_id,
                advertise_type: advertise_type,
                title: title,
                area: area,
                room: room,
                age: age,
                description: description,
                images: images,
                address: address,
                lat: lat,
                lng: lng,
                props: props,
                want_vr_tour: want_vr_tour,
                state_id: state_id,
                city_id: city_id
            })
                .then((response)=>{
                    console.log(response.data)
                })
                .catch((error)=>{});
        },
        deleteAdvertise(id){
            axios.default.delete('/dashboard/advertise/'+id, {
                id: id
            })
                .then((response)=>{
                    console.log(response)
                    window.location.reload(true)
                })
                .catch((error)=>{
                    console.log(error)
                })
        },
        clicked(){
            let items = $('.chk:checked');
            $.each(items, (item)=>{
                console.log(item);
            })

        },
    },
});
