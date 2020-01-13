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
            width: 100% !important;
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
            font-size: .8125rem !important;
            font-family: 'irsans';
        }
        .select2-selection__rendered{
            line-height: 2 !important;
            font-size: .8125rem !important;
        }
        .form-control{
            font-size: .8125rem !important;
        }
        </style>
@endsection
        @section('content')
            @include('home.map')
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
            L.cedarmaps.accessToken = "{{ $settings->map_api }}";
            let tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;
            let map = L.cedarmaps.map('map', tileJSONUrl, {
                scrollWheelZoom: true
            }).setView([34.7989, 48.5150], 14);
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
    });
</script>
<script src="{{ asset('js/select2.min.js') }}"></script>

@endsection
