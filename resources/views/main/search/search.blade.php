@extends('mainlayout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.min.css') }}">
    <style>
        #main-search-section{
            padding-top: 90px;
        }
        span.slc{
            background: #dc3545;
            color: #fff !important;
            border-radius: 15px;
        }
        .irs-grid-text, .irs-to, .irs-from, .irs-max, .irs-min{
            direction: ltr !important;
        }
        .irs-bar, .irs-line{
            height: 16px !important;
        }
    </style>
@endsection

@section('content')
    <section id="main-search-section">
        <div id="search-body" class="search-body">
            <div class="container">
                <div class="row">
                    <div id="search-result-box" class="col-12 col-sm-12 col-md-8">
                        <div class="row search-result-body">
                            <div class="container">
                                <div class="res-real-estates">
                                    <div class="row">
                                        @if(count($ads) > 0)
                                        @foreach($ads as $ad)
                                        <div class="col-12 col-sm-12 col-md-12 real-estate">
                                            <div class="row">
                                                <div class="real-estate-content col-12 col-sm-6 col-md-6">
                                                    <div class="real-estate-gallery">
                                                        <div class="real-estate-gallery-content">
                                                            <a href="/adv/{{ $ad->id }}">
                                                                <img src="{{ asset($ad->thumbnail) }}">
                                                            </a>
                                                        </div>
                                                        <span class="real-estate-gallery-images">
                                                            <i class="fas fa-camera"></i>
                                                            <span>{{ count($ad->gallery()->get()) }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="real-estate-header col-12 col-sm-6 col-md-6">
                                                    <h3><a href="/adv/{{ $ad->id }}">{{ $ad->title }}</a></h3>
                                                    <div class="real-estate-state">{{ $ad->city->name }}, {{ $ad->address }}</div>
                                                    <div class="real-estate-img">
                                                        <a href="/adv/{{ $ad->id }}"><img src="{{ asset($ad->real_estate->image) }}"></a>
                                                    </div>
                                                    <p class="real-estate-desc">
                                                        @if ($ad->advertise_type == \App\Advertise::TYPE_FOR_SELL) فروش @else اجاره @endif
                                                        {{  substr($ad->description , 0 , 200) }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12 real-estate-details">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6 col-md-6 real-estate-detail">
                                                            @if($ad->advertise_type == \App\Advertise::TYPE_FOR_SELL)
                                                                <span>قیمت:</span>
                                                                <span>{{ $ad->sell }}</span>
                                                                <span>تومان</span>
                                                            @else
                                                                <span>رهن:</span>
                                                                <span>{{ $ad->sell }}</span>
                                                                <span>تومان</span>
                                                                <span> - </span>
                                                                <span>اجاره:</span>
                                                                <span>{{ $ad->rent }}</span>
                                                                <span>تومان</span>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    <div class="release-date">
                                                        <span>انتشار:</span>
                                                        <span>{{ $ad->releaseAgo() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                            <h2 style="margin-top: 100px; margin-right: 20px">آگهی با مشخصات مورد نظر یافت نشد!</h2>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <nav class="page-nav" aria-label="Page Navigation">
                                {{ $ads->links() }}
                            </nav>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4">
                        <div id="property-search-box">
                            <form id="search" action="{{ route('search') }}" method="GET" class="property-search-form">
                                <div class="property-search">
                                    <h4 class="property-search-header">جست و جو برای</h4>
                                    <div class="property-search-type-btns text-center">
                                        <div class="property-search-type-box">
                                            <span id="pfa" class="type-btn stb @if($st == 'all') slc @endif">همه</span>
                                            <span id="pfb" class="type-btn stb @if($st == 'buy') slc @endif">خرید و فروش</span>
                                            <span id="pfr" class="type-btn stb @if($st == 'rent') slc @endif">رهن و اجاره</span>
                                        </div>
                                        <input type="hidden" name="st" id="st" value="{{ $st ? $st : '' }}">
                                    </div>
                                </div>
                                <div class="property-search">
                                    <h4 class="property-search-header"  data-toggle="collapse" data-target="#ul1"><span>نوع کاربری ملک</span><i class="fal fa-chevron-down property-drop-down"></i></h4>
                                    <ul id="ul1"  class="property-ul collapse">
                                        @foreach($estate_types as $type)
                                        <li><input name="ets[]" value="{{ $type->id }}" type="checkbox" @if(in_array($type->id, $ets)) checked @endif id="ul1-chk{{ $type->id }}" class="form-check property"><label for="ul1-chk{{ $type->id }}">{{ $type->title }}</label></li>
                                        @endforeach
                                    </ul>
                                </div>
{{--                                <div class="property-search">--}}
{{--                                    <h4 class="property-search-header"  data-toggle="collapse" data-target="#ul2"><span>منطقه ملک</span><i class="fal fa-chevron-down property-drop-down"></i></h4>--}}
{{--                                    <ul id="ul2"  class="property-ul collapse">--}}
{{--                                        <select name="state_id" class="form-control" id="property-choose-state">--}}
{{--                                            <option disabled selected >استان</option>--}}
{{--                                            @foreach($states as $s)--}}
{{--                                            <option value="{{ $s->id }}" @if($state && $s->id == $state->id) selected @endif>{{ $s->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        <select name="city_id"  class="form-control" id="property-choose-city">--}}
{{--                                            <option disabled selected >شهر</option>--}}
{{--                                            @foreach($cities as $c)--}}
{{--                                                <option value="{{ $c->id }}" @if($city && $c->id == $city->id) selected @endif>{{ $c->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
                                <div id="property-search-buy-box">
                                    <div class="property-search">
                                        <h4 class="property-search-header"  data-toggle="collapse" data-target="#ul3"><span>محدوده قیمت</span><i class="fal fa-chevron-down property-drop-down"></i></h4>
                                        <ul id="ul3"  class="property-ul collapse">
                                            <input id="price-range" class="js-range-slider" value="">
                                            <input type="hidden" id="pbpaf">
                                            <input type="hidden" id="pbpat">
                                            <div id="property-buy-price-amount">
                                                <div>
                                                    <span>قیمت از:</span>
                                                    <input type="text" disabled id="property-buy-price-amount-from-span">
                                                </div>
                                                <div>
                                                    <span>قیمت تا:</span>
                                                    <input type="text" disabled id="property-buy-price-amount-to-span">
                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                </div>

                                <div id="property-search-rent-box"  class="hide">
                                    <div class="property-search">
                                        <h4 class="property-search-header"  data-toggle="collapse" data-target="#ul4"><span>محدوده رهن</span><i class="fal fa-chevron-down property-drop-down"></i></h4>
                                        <ul id="ul4"  class="property-ul collapse">
                                            <input type="hidden" id="prpaf">
                                            <input type="hidden" id="prpat">
                                            <input id="rent-price-range" class="js-range-slider" value="">
                                            <div id="property-rent-price-amount">
                                                <div>
                                                    <span>رهن از:</span>
                                                    <input type="text" disabled id="prpaf-span">
                                                </div>
                                                <div>
                                                    <span>رهن تا:</span>
                                                    <input type="text" disabled id="prpat-span">
                                                </div>
                                            </div>
                                        </ul>
                                    </div>

                                    <div id="property-search-rent-box">
                                        <div class="property-search">
                                            <h4 class="property-search-header"  data-toggle="collapse" data-target="#ul5"><span>محدوده اجاره</span><i class="fal fa-chevron-down property-drop-down"></i></h4>
                                            <ul id="ul5"  class="property-ul collapse">
                                                <input type="hidden" id="praf">
                                                <input type="hidden" id="prat">
                                                <input id="rent-range" class="js-range-slider" value="">
                                                <div id="property-rent-amount">
                                                    <div>
                                                        <span>اجاره از:</span>
                                                        <input type="text" disabled id="property-rent-amount-from-span">
                                                    </div>
                                                    <div>
                                                        <span>اجاره تا:</span>
                                                        <input type="text" disabled id="property-rent-amount-to-span">
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="property-search">
                                    <h4 class="property-search-header"  data-toggle="collapse" data-target="#ul6"><span>تعداد اتاق</span><i class="fal fa-chevron-down property-drop-down"></i></h4>
                                    <ul id="ul6"  class="property-ul collapse">
                                        @foreach($room_nums as $r)
                                        @if($r->room)
                                            <li><input type="checkbox" name="rooms[]" value="{{ $r->room }}" @if(in_array($r->room, $rooms)) checked @endif id="ul6-chk1" class="form-check property"><label for="ul6-chk1">{{ $r->room }}</label></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="property-search">
                                    <h4 class="property-search-header"  data-toggle="collapse" data-target="#ul7"><span>امکانات</span><i class="fal fa-chevron-down property-drop-down"></i></h4>
                                    <ul id="ul7"  class="property-ul collapse">
                                        @foreach($properties as $p)
                                        <li><input type="checkbox" name="props[]" @if(in_array($p->id, $pids)) checked @endif value="{{ $p->id }}" id="ul7-chk{{ $p->id }}" class="form-check property"><label for="ul7-chk{{ $p->id }}">{{ $p->title }}</label></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="property-search">
                                    <button type="submit" id="property-search-filter-btn" class="btn btn-dark btn-outline-primary property-search-filter-btn">
                                        <i class="fas fa-filter"></i> فیلتر
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="{{ asset('js/ion.rangeSlider.min.js') }}"></script>
    <script>
        jq = $.noConflict();
        jq(document).ready(function () {
            $('#pfa').on('click', ()=>{
                $('#st').val('all');
                $('.stb').removeClass('slc');
                $('#pfa').addClass('slc');
                $('#search').submit();
            });
            $('#pfb').on('click', ()=>{
                $('#st').val('buy');
                $('.stb').removeClass('slc');
                $('#pfb').addClass('slc');
                $('#search').submit();
            });
            $('#pfr').on('click', ()=>{
                $('#st').val('rent');
                $('.stb').removeClass('slc');
                $('#pfr').addClass('slc');
                $('#search').submit();
            });
            $('.property').on('click', ()=>{
                $('#search').submit();
            });
            jq("#price-range").ionRangeSlider({
                type: "double",
                skin: 'flat',
                min: 0,
                max: '{{ $msp }}',
                from: 0,
                to: '{{ $msp }}',
                onChange: (data) =>{
                    $('#pbpaf').val(data.from);
                    $('#pbpat').val(data.to);
                    console.log(data)
                }
            });

        });
    </script>
@endsection
