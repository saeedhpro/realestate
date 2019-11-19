@extends('mainlayout')

@section('styles')
    <style>
        #escrow-form{
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            padding: 40px;
            text-align: right;
        }
        .form-control, .select2-selection{
            height: 2.5rem !important;
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff !important;
            background-clip: padding-box;
            border: 1px solid #ced4da !important;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            text-align: right !important;
            direction: rtl !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            left: 1px !important;
            right: unset !important;
            bottom: 0 !important;
            height: unset !important;
        }
        .select2-results{
            text-align: right !important;
            direction: rtl !important;
        }
        #escrow-section h4{
            margin: 50px auto 30px;
            text-align: center;
        }
        #map{
            width: 100%;
            height: 400px;
        }
        #submit-box{
            display: flex;
            justify-content: flex-end;
            width: 100%;
        }
        #submit{
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
            padding: 18px 50px;
        }
        textarea.form-control{
            height: auto !important;
        }
        .intl-tel-input{
            width: 100% !important;
            direction: ltr !important;
        }
    </style>
    <link href='{{ asset('css/map/cedar.css') }}' rel='stylesheet'/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/intl.tel.input.min.css') }}">

    <style>
        .vs__actions {
            left: 10px !important;
            position: absolute !important;
            top: 28% !important;
            text-align: right !important;
        }
    </style>
@endsection

@section('content')
    <section id="escrow-section" class="section">
        <h4>برای سپردن ملک خود اطلاعات زیر را کامل کنید</h4>
        <form class="card" id="escrow-form" style="border: 1px solid rgba(25, 25, 25, 0.2); border-radius: 10px;">
            <div class="row">
                <div class="form-group col-6 col-xs-12">
                    <label for="name-field">نام و نام خانوادگی</label>
                    <input type="text" class="form-control" id="name-field">
                    <div class="text-danger" id="name-error"></div>
                </div>
                <div class="form-group col-6 col-xs-12">
                    <label for="phone-input">شماره تماس</label>
                    <input type="text" class="form-control" id="phone-input" style="text-align: left!important;">
                    <div class="text-danger" id="phone-error"></div>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-6 col-xs-12">
                    <label for="et-filed">نوع کاربری ملک</label>
                    <select id="et-filed" class="select2-box form-control">
                        @foreach($estate_types as $et)
                            <option value="{{ $et->id }}">{{ $et->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6 col-xs-12">
                    <label for="advertise-type-filed">نوع واگذاری</label>
                    <select id="advertise-type-filed" class="select2-box form-control">
                        <option value="1">برای فروش</option>
                        <option value="2">برای رهن و اجاره</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-6 col-xs-12">
                    <label for="title-field">عنوان</label>
                    <input type="text" class="form-control" id="title-field">
                </div>
                <div class="form-group col-2 col-xs-4">
                    <label for="area-field">متراژ</label>
                    <input type="text" class="form-control" id="area-field">
                </div>
                <div class="form-group col-2 col-xs-4">
                    <label for="room-field">تعداد خواب</label>
                    <input type="text" class="form-control" id="room-field">
                </div>
                <div class="form-group col-2 col-xs-12">
                    <label for="age-field">سال ساخت</label>
                    <select id="age-field" class="select2-box form-control">
                        @for($i = 1398; $i > 1300; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-12">
                    <label for="description-field">توضیحات</label>
                    <textarea id="description-field" class="form-control" rows="6"></textarea>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-12">
                    <label for="dropzone">تصاویر</label>
                    <div class="dropzone" id="dropzone"></div>
                    <div id="images"></div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div style="display: none;" class="form-group col-6 col-xs-12">
                    <label for="state-field">استان</label>
                    <select @change="loadCities()" class="form-control" id="state-field">
                        @foreach($states as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="display: none;" class="form-group col-6 col-xs-12">
                    <label for="city-field">شهر</label>
                    <select disabled class="form-control" id="city-field"></select>
                </div>
                <div class="form-group col-12">
                    <label for="address-field">آدرس</label>
                    <textarea id="address-field" class="form-control" rows="6"></textarea>
                </div>
                <div class="form-group col-12">
                    <div id="map"></div>
                    <input type="hidden" id="lat">
                    <input type="hidden" id="lng">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-12">
                    <label>امکانات</label>
                    <div class="row">
                        @foreach($props as $p)
                            <div class="col-3" style="display: flex">
                                <input class="props" id="prop{{ $p->id }}" value="{{ $p->id }}" type="checkbox">
                                <label for="prop{{ $p->id }}">{{ $p->title }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group" id="submit-box">
                    <button class="btn" id="submit">سپردن ملک</button>
                </div>
            </div>
        </form>
    </section>
    <div>
        <input type="hidden" id="let">
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/map/cedar.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/intl.tel.input.min.js') }}"></script>

    <script>
        var jq = $.noConflict();
        jq(document).ready(function () {
            L.cedarmaps.accessToken = "2d9a80bd0ac9a48eeaca67fe606535a85f8ef57b";
            let tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;
            let map = L.cedarmaps.map('map', tileJSONUrl, {
                scrollWheelZoom: true
            }).setView([34.7989, 48.5150], 18);
            let myIcon = L.icon({
                iconUrl: '/images/map/marker.png',
                iconRetinaUrl: '/images/map/marker.png',
                iconSize: [34, 46],
                iconAnchor: [17, 41],
                popupAnchor: [-3, -46],
            });
            let markerAdded = false;
            let marker = null;
            map.on('click', (e)=>{
               if(!markerAdded) {
                   markerAdded = true;
               } else {
                   map.removeLayer(marker);
               }
                marker = new L.marker(e.latlng, {
                    icon: myIcon,
                    draggable: true,
                });
               marker.on('drag', (e) => {
                  jq('#lat').val(e.latlng.lat);
                  jq('#lng').val(e.latlng.lng);
                  map.flyTo(e.latlng);
               });
                marker.addTo(map);
                jq('#lat').val(e.latlng.lat);
                jq('#lng').val(e.latlng.lng);
                map.flyTo(e.latlng);
            });
        });
        jq(document).ready(function () {

            const mobileinput = document.querySelector("#phone-input");

            var iti = window.intlTelInput(mobileinput, {
                utilsScript: "{{ asset('js/telutils.js') }}",
                initialCountry: "ir",
                placeholderNumberType: "",
                onlyCountries: ["ir"]
            });

            var errorMap = ["شماره تلفن نادرست است", "کد کشور نادرست است", "شماره ی وارد شده بسیار کوتاه است", "شماره ی وارد شده بسیار طولانی است", "شماره درست را وارد کنید!"];

            jq("#mobile-input").on('blur', function () {
                reset();
                if(iti.isValidNumber()){
                    jq("#truephone").val(true);
                } else {
                    var errorCode = iti.getValidationError();
                    jq("#telerror").html(errorMap[errorCode]);
                    jq("#truephone").val(false);
                }
            });
            function reset() {
                jq("#telerror").html("");
                jq("#truephone").val(true);
            }

            jq(".select2-box").select2();
            jq(document).on('change', '#state-field', function () {
                let id = jq('#state-field').val();
                jq.ajax({url: "/states/"+id+'/cities', success: function(result){
                    jq.each(result, function (index, city) {
                        jq(`<option value="${city.id}">${city.name}</option>`).appendTo('#city-field');
                        jq('#city-field').prop('disabled', false);
                    });
                }});
            });
            jq("#escrow-form").on('submit', function (e) {
                e.preventDefault();
                let name = jq("#name-field").val();
                let phone = iti.getNumber();
                let estate_type = jq("#et-filed").val();
                let advertise_type = jq("#advertise-type-filed").val();
                let title = jq("#title-field").val();
                let area = jq("#area-field").val();
                let room = jq("#room-field").val();
                let age = jq("#age-field").val();
                let description = jq("#description-field").val();
                let lat = jq("#lat").val();
                let long = jq("#lng").val();
                let address = jq("#address-field").val();
                let tmps = jq(".props:checked");
                let props = [];
                for(let i = 0; i < tmps.length; i++){
                    props.push(jq(tmps[i]).val());
                }
                tmps = jq(".dropzone-images");
                let images = [];
                for(let i = 0; i < tmps.length; i++){
                    images.push(jq(tmps[i]).val());
                }
                jq.ajax({
                    url: '{{ url(route('advertise.escrow.store')) }}',
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name,
                        phone: phone,
                        estate_type: estate_type,
                        advertise_type: advertise_type,
                        title: title,
                        area: area,
                        room: room,
                        age: age,
                        description: description,
                        lat: lat,
                        long: long,
                        address: address,
                        props: props,
                        images: images,
                    },
                    success: (response)=>{
                        console.log("res: ", response);
                    },
                    error: (error)=>{
                        if(error.responseJSON.errors.name){
                            jq("#name-error").html(error.responseJSON.errors.name[0]);
                        }
                        if(error.responseJSON.errors.phone){
                            jq("#phone-error").html(error.responseJSON.errors.phone[0]);
                        }
                    }
                });
            });
        });
        Dropzone.autoDiscover = false;
        jq(document).ready(()=> {
            let dropzone = new Dropzone("#dropzone", {
                url: '{{ url('/api/upload/') }}',
                maxFilesize: 150,
                maxFiles: 10,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 5000,
            });
            dropzone.on("success", function (file, response) {
                jq(file.previewTemplate).append(`<input type="hidden" value="${response.id}"/>`);
                let image = `<input id="image-${response.id}" class="dropzone-images" v-model="images" type="hidden" value="${response.id}">`;
                // console.log(image);
                jq("#images").append(image);
            });
            dropzone.on("error", function (error) {
                console.log(error)
            });
            dropzone.on("removedfile", function (file) {
                let id = $(file.previewTemplate).find('input').val();
                // console.log(input);
                jq.ajax({
                    url: '/upload/' + id + '/delete',
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                    },
                    success: (response) => {
                    },
                    error: (response) => {
                    }
                });
            });
        });
    </script>
@endsection
