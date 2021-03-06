@extends('dashboard.dashboardlayout')

@section('styles')
    <link href='{{ asset('css/map/cedar.css') }}' rel='stylesheet'/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
    <style>
        .vs__actions {
            left: 10px !important;
            position: absolute !important;
            top: 28% !important;
            text-align: right !important;
        }
    </style>
    <style>
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
        .select2-container{
            max-width: 100%;
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
        .form-group .bmd-label-static {
            position: unset;
        }
        .select2-dropdown.select2-dropdown--below, .select2-dropdown.select2-dropdown--above{
            overflow-y: scroll;
            max-height: 250px !important;
        }
        textarea.form-control{
            height: auto !important;
        }
    </style>

    <style>
        .switch-input {
            display: none;
        }
        .switch-label {
            position: relative;
            display: inline-block;
            /*min-width: 112px;*/
            cursor: pointer;
            font-weight: 500;
            text-align: right;
            padding: 16px 0 16px 44px;
        }
        .switch-label:before, .switch-label:after {
            content: "";
            position: absolute;
            margin: 0;
            outline: 0;
            top: 50%;
            -ms-transform: translate(0, -50%);
            -webkit-transform: translate(0, -50%);
            transform: translate(0, -50%);
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
        .switch-label:before {
            left: 1px;
            width: 34px;
            height: 14px;
            background-color: #9E9E9E;
            border-radius: 8px;
        }
        .switch-label:after {
            left: 0;
            width: 20px;
            height: 20px;
            background-color: #FAFAFA;
            border-radius: 50%;
            box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.14), 0 2px 2px 0 rgba(0, 0, 0, 0.098), 0 1px 5px 0 rgba(0, 0, 0, 0.084);
        }
        .switch-label .toggle--on {
            display: none;
        }
        .switch-label .toggle--off {
            display: inline-block;
        }
        .switch-input:checked + .switch-label:before {
            background-color: #A5D6A7;
        }
        .switch-input:checked + .switch-label:after {
            background-color: #4CAF50;
            -ms-transform: translate(80%, -50%);
            -webkit-transform: translate(80%, -50%);
            transform: translate(80%, -50%);
        }
        .switch-input:checked + .switch-label .toggle--on {
            display: inline-block;
        }
        .switch-input:checked + .switch-label .toggle--off {
            display: none;
        }

    </style>
    <style>
        .md-checkbox {
            position: relative;
            margin: 1em 0;
            text-align: right;
        }
        .md-checkbox.md-checkbox-inline {
            display: inline-block;
        }
        .md-checkbox label {
            cursor: pointer;
            display: inline;
            line-height: 1.25em;
            vertical-align: top;
            clear: both;
            padding-right: 1px;
        }
        .md-checkbox label:not(:empty) {
            padding-right: 0.75em;
        }
        .md-checkbox label:before, .md-checkbox label:after {
            content: "";
            position: absolute;
            right: 0;
            top: 0;
        }
        .md-checkbox label:before {
            width: 1.25em;
            height: 1.25em;
            background: #fff;
            border: 2px solid rgba(0, 0, 0, 0.54);
            border-radius: 0.125em;
            cursor: pointer;
            transition: background 0.3s;
        }
        .md-checkbox input[type=checkbox] {
            outline: 0;
            visibility: hidden;
            width: 1.25em;
            margin: 0;
            display: block;
            float: right;
            font-size: inherit;
        }
        .md-checkbox input[type=checkbox]:checked + label:before {
            background: #337ab7;
            border: none;
        }
        .md-checkbox input[type=checkbox]:checked + label:after {
            transform: translate(0.25em, 0.3365384615em) rotate(-45deg);
            width: 1em;
            height: 0.375em;
            border: 0.125em solid #fff;
            border-top-style: none;
            border-right-style: none;
            right: 5px !important;
        }
        .md-checkbox input[type=checkbox]:disabled + label:before {
            border-color: rgba(0, 0, 0, 0.26);
        }
        .md-checkbox input[type=checkbox]:disabled:checked + label:before {
            background: rgba(0, 0, 0, 0.26);
        }
        .center-box{
            margin: 0 auto !important;
        }
        .show{
            display: flex !important;
        }

        .vrtour + .lcs_switch {
            width: 115px !important;
        }
        .vrtour + .lcs_switch .lcs_label{
            width: 70px;
        }
        .vrtour + .lcs_switch.lcs_on .lcs_cursor{
            left: 88px;
        }
        .prop-box{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #properties label{
            display: block;
            width: 100%;
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('/css/lc_switch.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 center-box">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">ثبت آگهی</h4>
                    <a href="{{ url()->previous() }}" class="back-button mr-auto d-inline-flex">
                        <i class="fas fa-arrow-alt-left"></i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.advertise.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-8">
                                <div class="form-group">
                                    <label for="title" class="bmd-label-static">عنوان آگهی</label>
                                    <input id="title" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-4 prop-box">
                                <label for="want-vr-tour">نمای مجازی می خواید؟</label>
                                <input type="checkbox" id="want-vr-tour" name="want-vr-tour" value="1" class="vrtour" >
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="estate_type_id" class="bmd-label-floating">نوع کاربری ملک</label>
                                    <select id="estate_type_id" class="select2-box form-control">
                                        @foreach($estate_types as $et)
                                            <option value="{{ $et->id }}">{{ $et->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="advertise_type">نوع واگذاری</label>
                                        <select id="advertise_type" class="select2-box form-control">
                                        <option value="1">فروش</option>
                                        <option value="2">رهن و اجاره</option>
                                        <option value="3">معاوضه</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row show" id="sell-box" style="display: none;">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="sell">قیمت فروش</label>
                                    <input class="form-control" id="sell" type="number">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="rent-box" style="display: none;">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="rent-sell" class="bmd-label-static">رهن</label>
                                    <input class="form-control" id="rent-sell" type="number">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="rent">اجاره</label>
                                    <input class="form-control" id="rent" type="number">
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label for="area" class="bmd-label-static">متراژ</label>
                                    <input id="area"min="1" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label for="rooms" class="bmd-label-static">تعداد اتاق</label>
                                    <input id="rooms" min="0" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label for="age" class="bmd-label-floating">سال ساخت</label>
                                    <select id="age" class="select2-box form-control">
                                        @for($i = \App\Helpers\toJalali()->year; $i > 1300; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label for="floors" class="bmd-label-static">تعداد کل طبقات؟</label>
                                    <input id="floors" min="1" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label for="unit" class="bmd-label-static">واحد در کدام طبقه است؟</label>
                                    <input id="unit" min="1" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label for="units" class="bmd-label-static">تعداد واحد در طبقه؟</label>
                                    <input id="units" min="1" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-12 col-sm-4 col-md-3 prop-box" style="display: flex; justify-content: space-between; margin-top: 30px; margin-bottom: -15px;">
                                        <label for="has-elevator">آسانسور دارد*</label>
                                        <input type="checkbox" id="has-elevator" name="has-elevator" value="1" class="properties" />
                                    </div>
                                    <div class="form-group col-12 col-sm-4 col-md-3 prop-box" style="display: flex; justify-content: space-between; margin-top: 30px; margin-bottom: -15px;">
                                        <label for="has-parking">پارکینگ دارد*</label>
                                        <input type="checkbox" id="has-parking" name="has-parking" value="2" class="properties" />
                                    </div>
                                </div>
                                <hr/>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="region-filed">محدوده</label>
                                <select id="region-filed" class="select2-box form-control">
                                    @foreach($settings->city->regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address">آدرس</label>
                                    <textarea id="address" v-model="address" class="form-control" rows="6"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description" class="bmd-label-static">توضیحات</label>
                                    <textarea class="form-control" id="description" v-model="description" rows="6"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="hidden" value="" v-model="lat" id="lat">
                                    <input type="hidden" value="" v-model="lng" id="lng">
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row" id="properties">
                            <label class="bmd-label-static" style="width: 100%; margin-right: 10px; font-size: 16px;">امکانات:</label>
                            <br />
                            <div class="col-12">
                                <div class="row">
                                @foreach($props as $p)
                                    <div class="form-group col-12 col-sm-4 col-md-3" style="display: flex; justify-content: space-between; margin-top: 30px; margin-bottom: -15px;">
                                        <label for="prop{{ $p->id }}">{{ $p->title }}</label>
                                        <input type="checkbox" id="prop{{ $p->id }}" name="props[]" value="{{ $p->id }}" class="properties props" />
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="dropzone" class="bmd-label-static" style="width: 100%; margin-right: 10px; font-size: 16px;">تصایر:</label>
                                    <div id="dropzone" class="dropzone"></div>
                                    <div id="images"></div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <button id="storeAdvertise" type="submit" class="btn btn-primary pull-right">ثبت آگهی</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/map/cedar.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/lc_switch.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            L.cedarmaps.accessToken = "{{ $settings->map_api }}";
            let tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;
            let map = L.cedarmaps.map('map', tileJSONUrl, {
                scrollWheelZoom: true
            }).setView([{{ $settings->city->lat }}, {{ $settings->city->lng }}], 14);
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
                    $('#lat').val(e.latlng.lat);
                    $('#lng').val(e.latlng.lng);
                    map.flyTo(e.latlng);
                });
                marker.addTo(map);
                $('#lat').val(e.latlng.lat);
                $('#lng').val(e.latlng.lng);
                map.flyTo(e.latlng);
            });
        });
        $(document).ready(function () {
            $("#advertise_type").select2({
                theme: 'material'
            }).on('select2:select', (e) => {
                console.log(e, 'changed')
                $("#sell-box").toggleClass('show');
                $("#rent-box").toggleClass('show');
            });
            $("#estate_type_id").select2({
                theme: 'material'
            });
            $("#age").select2({
                theme: 'material'
            });
            $("#region-filed").select2({
                theme: 'material'
            });
            $(document).on('change', '#state-field', function () {
                let id = $('#state-field').val();
                $.ajax({url: "/states/"+id+'/cities', success: function(result){
                        $.each(result, function (index, city) {
                            $(`<option value="${city.id}">${city.name}</option>`).appendTo('#city-field');
                            $('#city-field').prop('disabled', false);
                        });
                    }});
            });
        });
        Dropzone.autoDiscover = false;
        $(document).ready(()=>{
            $('.properties').lc_switch('دارد', 'ندارد');
            $('.vrtour').lc_switch('می خواهم', 'نمی خواهم');

            let dropzone = new Dropzone("#dropzone", {
                url: '{{ url('/api/upload/') }}',
                maxFilesize: 150,
                maxFiles: 10,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 5000,
                capture: "CAMERA"
            });
            dropzone.on("success", function (file, response) {
                $(file.previewTemplate).append(`<input type="hidden" value="${response.id}"/>`);
                let image = `<input id="image-${response.id}" class="dropzone-images" v-model="images" type="hidden" value="${response.id}">`;
                // console.log(image);
                $("#images").append(image);
            });
            dropzone.on("error", function (error) {
                console.log(error);
            });
            dropzone.on("removedfile", function (file) {
                var id = $(file.previewTemplate).find('input').val();
                // console.log(input);
                $.ajax({
                    url: '/upload/'+id+'/delete',
                    type:'DELETE',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                    },
                    success: (response)=>{
                    },
                    error: (response)=>{
                    }
                });
            });
        });
        $(document).ready(()=>{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#storeAdvertise').on("click", function(e){
                e.preventDefault();
                let estate_type_id = $("#estate_type_id").val();
                let advertise_type = $("#advertise_type").val();
                let title = $("#title").val();
                let area = $("#area").val();;
                let room = $("#rooms").val();
                let age = $("#age").val();
                let description = $("#description").val();
                let tmps = $(".dropzone-images");
                let images = [];
                for(let i = 0; i < tmps.length; i++){
                    images.push($(tmps[i]).val());
                }
                let region_id = $("#region-filed").val();
                let address = $("#address").val();
                let lat = $('#lat').val();
                let lng = $('#lng').val();
                tmps = $(".props:checked");
                let props = [];
                for(i = 0; i < tmps.length; i++){
                    props.push($(tmps[i]).val());
                }
                let sell = 0;
                if(advertise_type === 1){
                    sell = $("#sell").val()
                } else {
                    sell = $("#rent-sell").val();
                }
                let rent = $("#rent").val();
                let state_id = 30;
                let city_id = 1225;
                let has_elevator = $("#has-elevator").is(':checked');
                let has_parking = $("#has-parking").is(':checked');
                let floors = $("#floors").val();
                let unit = $("#unit").val();
                let units = $("#units").val();
                let want_vr_tour = $("#want-vr-tour").is(':checked');
                $.post({
                    url: '{{ route('dashboard.advertise.store') }}',
                    '_token': '{{ csrf_token() }}',
                    data: {
                        estate_type_id: estate_type_id,
                        advertise_type: advertise_type,
                        title: title,
                        has_elevator: has_elevator,
                        has_parking: has_parking, area: area,
                        floors: floors,
                        units: units,
                        unit: unit,
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
                        city_id: city_id,
                        sell: sell,
                        rent: rent,
                        region_id: region_id,
                    },
                    success: (response) => {
                        alert('آگهی با موفقیت ثبت شد!');
                        window.location.replace('{{ route('home') }}');
                        // console.log('response', response);
                    },
                    error: (error) => {
                        alert('متاسفانه خطایی رخ داده است!');
                        console.log('error', error);
                    }
                });

            });
        });
    </script>
@endsection
