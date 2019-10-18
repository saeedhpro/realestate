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
    </style>
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
@endsection

@section('content')
    <section id="escrow-section" class="section">
        <h4>برای سپردن ملک خود اطلاعات زیر را کامل کنید</h4>
        <form class="card" id="escrow-form" style="border: 1px solid rgba(25, 25, 25, 0.2); border-radius: 10px;">
            <div class="row">
                <div class="form-group col-6 col-xs-12">
                    <label for="name-field">نام و نام خانوادگی</label>
                    <input type="text" v-model="userName" class="form-control" id="name-field">
                </div>
                <div class="form-group col-6 col-xs-12">
                    <label for="phone-field">شماره تماس</label>
                    <input type="text" v-model="userPhone" class="form-control" id="phone-field">
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
                    <label for="sell-filed">نوع واگذاری</label>
                    <select id="sell-filed" class="select2-box form-control">
                        <option value="1">برای فروش</option>
                        <option value="2">برای رهن و اجاره</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-6 col-xs-12">
                    <label for="title-field">عنوان</label>
                    <input v-model="advTitle" type="text" class="form-control" id="title-field">
                </div>
                <div class="form-group col-2 col-xs-4">
                    <label for="area-field">متراژ</label>
                    <input v-model="area" type="text" class="form-control" id="area-field">
                </div>
                <div class="form-group col-2 col-xs-4">
                    <label for="room-field">تعداد خواب</label>
                    <input v-model="room" type="text" class="form-control" id="room-field">
                </div>
                <div class="form-group col-2 col-xs-12">
                    <label for="age-field">سن</label>
                    <input v-model="age" type="text" class="form-control" id="age-field">
                </div>
                <div class="form-group col-12">
                    <label for="description-field">توضیحات</label>
                    <textarea v-model="description" id="description-field" class="form-control" rows="6"></textarea>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-12">
{{--                    <div class="dropzone" id="dropzone"></div>--}}
                    <label for="dropzone">تصاویر</label>
                    <div class="dropzone" id="dropzone"></div>
                    {{--                    <dropzone ref="dropzoneSingle" id="images-field" :options="dropzoneSingleOptions" @vdropozne-complete="dropzoneSingleAfterComplete"></dropzone>--}}
                <div id="images"></div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div style="display: none;" class="form-group col-6 col-xs-12">
                    <label for="state-field">استان</label>
                    <select @change="loadCities()" v-model="state_id" class="form-control" id="state-field">
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
                    <textarea v-model="address" id="address-field" class="form-control" rows="6"></textarea>
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
                                <input v-model="props" :value="{{ $p->id }}" id="prop{{ $p->id }}" type="checkbox">
                                <label for="prop{{ $p->id }}">{{ $p->title }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="form-group" id="submit-box">
                    <button @click.prevent="escrowAdv" class="btn" id="submit">سپردن ملک</button>
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
        });
        Dropzone.options.dropzone = {
            url: '{{ url('/api/upload/') }}',
            maxFilesize: 150,
            maxFiles: 10,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            success: function (file, response) {
                $.each(response, (file) => {
                    console.log(file.id);
                    let image = new Input(`<input type="hidden" value="${file.id}>`);
                    console.log(image);
                    image.appendTo("#images");
                });
            },
            error: function (file, response) {
                return false;
            },
            removedFile: (file) => {
                console.log(file);
            },
        };
    </script>
@endsection
