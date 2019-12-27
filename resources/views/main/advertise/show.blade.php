@extends('mainlayout')

@section('styles')
    <link href='{{ asset('css/map/cedar.css') }}' rel='stylesheet'/>
    <link href="{{ asset('css/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/fancybox.min.css') }}">
    <style>
        .description{
            line-height: 2;
            margin: 5px;
        }
        #map{
            width: 100%;
            height: 450px;
            margin-top: 24px;
            border: 1px solid rgba(0,0,0, 0.18);
        }
    </style>
@endsection

@section('content')
    <section id="estate-section" class="section estate-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-8">
                    <div id="estate-show-box">
                        <div class="estate-header">
                            <h1 class="estate-title">{{ $advertise->title }} <span class="text-muted type-12">({{ $advertise->city->name }})</span></h1>
                            <address class="estate-address">
                                <i class="fas fa-map-marker-check"></i>
                                 {{ $advertise->address }}
                            </address>
                        </div>
                        <hr/>
                        @if($advertise->gallery())
                        <div id="gallery-box" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($advertise->gallery()->get() as $img)
                                <a data-fancybox="gallery" class="carousel-item @if($loop->first) active @endif"
                                   href="{{ asset($img->path) }}">
                                    <img class="gallery-item-img" src="{{ asset($img->path) }}">
                                </a>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#gallery-box" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">قبلی</span>
                            </a>
                            <a class="carousel-control-next" href="#gallery-box" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">بعدی</span>
                            </a>
                        </div>
                        <hr/>
                        <div class="price hidden-xs hidden-sm">
                            @if($advertise->advertise_type == \App\Advertise::TYPE_FOR_SELL)
                                <span>  قیمت: {{ $advertise->sell }} تومان  </span>
                            @else
                                <span>  رهن: {{ $advertise->sell }} تومان  </span>
                                <br/>
                                <span>  اجاره: {{ $advertise->rent }} تومان  </span>
                            @endif
                        </div>
                        <hr/>
                        @endif
                        <div id="estate-description" class="estate-description">
                            <h2 class="estate-title">
                                توضیحات
                            </h2>
                            <p class="description">
                                {{ $advertise->description }}
                            </p>
                        </div>
                        @if(count($advertise->properties->all()) > 0)
                        <hr/>
                        <div id="properties-box">
                            <h2 class="estate-title">
                                امکانات
                            </h2>
                            <div class="properties">
                                @foreach($advertise->properties as $property)
                                    <span class="property"><i class="fas fa-check-square"></i>{{ $property->title }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @if($advertise->lat && $advertise->lng)
                        <hr/>
                        <div id="map-address">
                            <h2 class="estate-title">
                                موقعیت روی نقشه
                            </h2>
                            <div>
                                <div id="map"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                    @if($advertise->tour)
                    <div class="card" style="margin-top: 20px;">
                        <div id="estate-vrtour">
                            <a href="{{ route('advertise.tour', $advertise->id) }}" id="vrtour-box">
                                <span id="tour-hover"></span>
                                <img src="{{ $advertise->thumbnail }}">
                                <span id="view-tour">
                                <i class="fas fa-camera" style="margin-left: 10px;"></i>
                                <p>مشاهده ی تور مجازی</p>
                            </span>
                            </a>
                        </div>
                    </div>
                    @endif
                    @if($advertise->real_estate)
                    <div class="card property-search-form">
                        <div class="real-estate-name-box">
                            <a href="#"><span class="real-estate-name">{{ $advertise->real_estate->name }}({{ $advertise->real_estate->city->name }})</span></a>
                            <span class="real-estate-emp-name">صادقی</span>
                            <a href="#"><img src="{{ $advertise->real_estate->image }}" class="real-estate-name-img img-responsive"></a>
                            <p class="estate-code">
                            </p><div>هنگام تماس به کد آگهی اشاره فرمایید</div>
                            <span>شماره مرجع:</span>
                            <span class="nums">{{ $advertise->id }}#</span>
                            <p></p>
                        </div>
                        <div class="real-estate-contact-box">
                            <div class="text-center">
                                <button @click="showPhoneMethod()" id="phone-btn" class="btn btn-light btn-outline-danger">
                                    <i class="fas fa-phone"></i>
                                    <span>تماس</span>
                                </button>
                                <button @click="showEmailMethod" id="email-btn" class="btn btn-light btn-outline-danger">
                                    <i class="fas fa-envelope"></i>
                                    <span>ایمیل</span>
                                </button>
                                <div v-show="showPhone" class="real-estate-contact-detail" id="real-estate-phone-detail">
                                    <h5>اطلاعات تماس</h5>
                                    <div class="tel-link text-right">نماینده: <span class="text-left">صادقی</span></div>
                                    <div class="tel-link text-right">تلفن همراه: <a href="tel:{{ $advertise->real_estate->phone }}" class="text-left">{{ $advertise->real_estate->phone }}</a></div>
                                </div>
                                <div v-show="showEmail" class="real-estate-contact-detail" id="real-estate-email-detail">
                                    <h5>اطلاعات تماس</h5>
                                    <div class="tel-link text-right">نماینده: <span class="text-left">صادقی</span></div>
                                    <div class="tel-link text-right">ایمیل: <a href="mailto:{{ $advertise->real_estate->email }}" class="text-left">{{ $advertise->real_estate->email }}</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
           @if(count($similar_ads) > 0)
                <div class="similar-advs row" style="margin-top: 40px;">
                    <div class="col-md-12">
                        <h3 class="estate-title text-right">آگهی های مشابه</h3>
                        <div class="owl-carousel">
                           @foreach($similar_ads as $sa)
                                <div class="list-item compact">
                                    <a class="list-item-link" href="/adv/{{ $sa->id }}">
                                        <img class="list-item-image" src="{{ asset('images/home.jpg') }}">
                                    </a>
                                    <span class="listing-compact-title padding-10">
                                        <a href="/adv/{{ $sa->id }}" class="fix-text">{{ $sa->title }}</a>
                                        <span class="text-muted font-13 font-normal block">({{ $sa->city->name }})</span>
                                        <hr class="margin-bottom-10">
                                        @if($sa->advertise_type == \App\Advertise::TYPE_FOR_SELL)
                                        <i>قیمت: {{ $sa->sell }} تومان</i>
                                        @else
                                        <i>رهن: {{ $sa->sell }} تومان</i>
                                        <i>اجاره: {{ $sa->rent }} تومان</i>
                                        @endif
                                    </span>
                                </div>
                           @endforeach
                        </div>
                    </div>
                </div>
           @else
               <div><p>آگهی موجود نیست</p></div>
           @endif
        </div>
    </section>
    @if($advertise->lat && $advertise->lng)
        <input id="center-lat" type="hidden" value="{{ $advertise->lat }}">
        <input id="center-lng" type="hidden" value="{{ $advertise->lng }}">
        <input id="marker-lat" type="hidden" value="{{ $advertise->lat }}">
        <input id="marker-lng" type="hidden" value="{{ $advertise->lng }}">
    @endif

@endsection

@section('scripts')
    <script src="{{ asset('js/map/cedar.js') }}"></script>
    <script src="{{ asset('js/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/js/fancybox.min.js') }}"></script>
    <script type="text/javascript">
        var jq = $.noConflict();

        jq(document).ready(()=>{
            @if($advertise->lat && $advertise->lng)
            initMap();
            @endif
            initOwlCarousel();
        });
        function initMap() {
            L.cedarmaps.accessToken = "2d9a80bd0ac9a48eeaca67fe606535a85f8ef57b";
            var tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;
            let centerLat = $("#center-lat").val();
            let centerLng = $("#center-lng").val();
            let markerLat = $("#marker-lat").val();
            let markerLng = $("#marker-lng").val();
            var map = L.cedarmaps.map('map', tileJSONUrl, {
                scrollWheelZoom: true
            }).setView([centerLat, centerLng], 15);
            var myIcon = L.icon({
                iconUrl: '/images/map/marker.png',
                iconRetinaUrl: '/images/map/marker.png',
                iconSize: [34, 46],
                iconAnchor: [17, 41],
                popupAnchor: [-3, -46],
            });
            let marker = new L.marker([markerLat, markerLng], {
                icon: myIcon,
                id: 1,
            }).addTo(map);
        }
        function initOwlCarousel() {
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
        }
    </script>

@endsection
