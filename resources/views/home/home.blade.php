@extends('mainlayout')

@section('styles')
    <link href='{{ asset('css/map/cedar.css') }}' rel='stylesheet'/>
    <link href='{{ asset('css/map/markercluster.css') }}' rel='stylesheet'/>
    <link href="{{ asset('css/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
    <style>
        #map-section{
            padding-top: 96px;
        }
        #map{
            width: 100%;
            /*height: calc(90vh - 92px);*/
            height: calc(100vh - 92px);
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bs4.min.css') }}">
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
        .select2-dropdown.select2-dropdown--below, .select2-dropdown.select2-dropdown--above{
            overflow-y: scroll;
            /*max-height: 250px !important;*/
        }
        .select2-selection__rendered{
            height: 44px !important;
            line-height: 2 !important;
            font-size: 14px !important;
        }
        .select2-container .select2-selection--single{
            height: 44px !important;
        }
        .form-control{
            height: 44px !important;
            font-size: 14px !important;
        }
        </style>
@endsection
        @section('content')
            @include('home.map')
{{--            @include('home.search')--}}
{{--            @include('home.lastsell')--}}
{{--            @include('home.lastrent')--}}
{{--            @include('home.info')--}}
{{--            @include('home.bestrealestates')--}}
        @endsection
        @section('scripts')
    <script src="{{ asset('js/map/cedar.js') }}"></script>
    <script src="{{ asset('js/map/markercluster.js') }}"></script>
    <script src="{{ asset('js/owlcarousel/owl.carousel.min.js') }}"></script>
    <script>
        var jq = $.noConflict();

        jq(document).ready(function() {
            jq(".owl-carousel").owlCarousel({
                rtl: true,
                loop: true,
                margin: 15,
                nav: true,
                items: 3,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 2,
                        nav: false
                    },
                    1000: {
                        items: 4,
                        nav: true,
                        loop: false
                    }
                }
            });
        });
    </script>
    <script type="text/javascript">
        jq(document).ready(function () {
            L.cedarmaps.accessToken = "2d9a80bd0ac9a48eeaca67fe606535a85f8ef57b";
            let tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;
            let map = L.cedarmaps.map('map', tileJSONUrl, {
                scrollWheelZoom: true
            }).setView([34.7989, 48.5150], 15);
            let myIcon = L.icon({
                iconUrl: '/images/map/marker.png',
                iconRetinaUrl: '/images/map/marker.png',
                iconSize: [34, 46],
                iconAnchor: [17, 41],
                popupAnchor: [-3, -46],
            });
            let markers = L.markerClusterGroup();
            jq.get('/getmarkers', function (response, status) {
                response.forEach((item) => {
                    let marker = new L.marker([item.lat, item.lng], {
                        icon: myIcon,
                        id: item.id,
                    });
                    marker.bindPopup("<a href='/adv/" + item.id + "'>" + item.title + "</a>", {id: item.id, icon: myIcon, title: item.title});
                    markers.addLayer(marker);
                    map.addLayer(markers);
                });
            });
            jq(document).on('change', '#choose-state-select', function () {
                let id = jq('#choose-state-select').val();
                jq.ajax({url: "/states/"+id+'/cities', success: function(result){
                    jq.each(result, function (index, city) {
                        jq(`<option value="${city.id}">${city.name}</option>`).appendTo('#choose-city-select');
                        jq('#choose-city-select').prop('disabled', false);
                    })
                }});
            });
        });
    </script>
<script>
    jq(document).ready(function () {
        jq("#choose-sector-select").select2({
            theme: 'material'
        });
        jq("#choose-type-select").select2({
            theme: 'material'
        });
        var page = 1;
        {{--jq("#search-form").on('submit', function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    let estate_type_id = jq("#choose-sector-select").val();--}}
        {{--    let st = jq("#choose-type-select").val();--}}
        {{--    let area_from = jq("#area-from-field").val();--}}
        {{--    let area_to = jq("#area-to-field").val();--}}
        {{--    let room = jq("#room-field").val();--}}
        {{--    let age = jq("#age-field").val();--}}
        {{--    let price_from = jq("#price-from-field").val();--}}
        {{--    let price_to = jq("#price-to-field").val();--}}
        {{--    jq.ajax({--}}
        {{--        url: '{{ route('searchAjax') }}',--}}
        {{--        method: 'POST',--}}
        {{--        data: {--}}
        {{--            'estate_type_id': estate_type_id,--}}
        {{--            'st': st,--}}
        {{--            'area_from': area_from,--}}
        {{--            'area_to': area_to,--}}
        {{--            'room': room,--}}
        {{--            'age': age,--}}
        {{--            'price_from': price_from,--}}
        {{--            'price_to': price_to--}}
        {{--        },--}}
        {{--        success: function (res) {--}}
        {{--            jq("#adv-box").html('');--}}
        {{--            jq.each(res.data.collection, (index, item)=> {--}}
        {{--                let i = (`<div class="col-12">--}}
        {{--                        <div class="card" style="width: 100% !important;">--}}
        {{--                            <div class="card-body">--}}
        {{--                                <div class="row">--}}
        {{--                                    <div class="col-12 col-sm-4 col-lg-4 col-md-4">--}}
        {{--                                        <img alt="${item.title}" style="width: 100%; border: 1px solid rgba(0,0,0,0.5);" src="${item.thumbnail}">--}}
        {{--                                    </div>--}}
        {{--                                    <div class="col-12 col-sm-8 col-md-8 col-lg-8" style="text-align: right;">--}}
        {{--                                        <a href="/adv/${item.id}">${item.title}</a>--}}
        {{--                                        <p style="font-size: 13px" class="address">${item.address}</p>--}}
        {{--                                        <p style="font-size: 13px" class="address"><span>اتاق: ${ item.room }</span> -  <span>متراژ: ${ item.area } متر</span> </p>--}}
        {{--                                        ${ item.advertise_type == 1 ? `<div><p style="font-size: 13px; left: 15px" class="address btn-danger alerted">${item.status}</p></div>` : '' }--}}
        {{--                                        ${ item.advertise_type == 1 ? 'قیمت: ' + item.sell + 'تومان' : 'رهن: ' + item.sell + 'تومان' + ' - اجاره: ' + item.rent + 'تومان' }--}}
        {{--                                        </p>--}}
        {{--                                        <div>--}}
        {{--                                            <div class="form-group compare-chk-box">--}}
        {{--                                                <input type="checkbox" id="compare-${item.id}" ref="compare-${item.id}" v-model="compares" @change="compareChk(${item.id})" value="${item.id}" class="compare-chk">--}}
        {{--                                                <label for="compare-${item.id}" class="compare-label text-danger">مقایسه</label>--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                        <p style="font-size: 13px" class="address res">${item.re_name}</p>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>`);--}}
        {{--                jq("#adv-box").append(i)--}}
        {{--            });--}}
        {{--        },--}}
        {{--        error: function (error) {--}}
        {{--            console.log(error);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    });
    jq(document).ready(() => {
        var j = 0;
        jq(".compare-chk").on('change', (e)=>{
            // let compareBox = jq("#compare-ids");
            // let cids = jq(".cids");
            // jq.each(jq(".cids"), (index, item)=>{
            //     console.log(item);
            // });
            // if(j < 4){
            //     let id = e.target.value;
            //     let i = `<input type="hidden" class="cids" id="cids-${id}" value="${id}">`;
            //     if(compareBox.append(i)) {
            //         j++;
            //         console.log(j);
            //     }
            // }
            // if(cids.length < 4){
                // let values = jq.each(cids, (item)=>{
                //     console.log(item.val())
                // });
                // console.log(jq.inArray(id, values));
                // console.log(cids);
                // if(jq.inArray(id, cids) < 0) {

            // } else {
                //     let c = jq("#cids-"+id);
                //     c.remove();
                // }


            // length = jq("#compare-ids input").length;
            // jq("#number").html(length);
            // if(cids.length > 0){
            //     compareBox.css({"display": "flex"});
            // } else {
            //     compareBox.css({"display": "none"});
            // }
        });
    });
</script>
<script src="{{ asset('js/select2.min.js') }}"></script>

@endsection
