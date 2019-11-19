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
            height: calc(90vh - 92px);
        }
    </style>
@endsection
@section('content')
    @include('home.map')
    @include('home.search')
    @include('home.lastsell')
    @include('home.lastrent')
    @include('home.info')
    @include('home.bestrealestates')
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


@endsection
