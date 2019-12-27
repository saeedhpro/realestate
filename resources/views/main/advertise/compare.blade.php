@extends('mainlayout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <style>
        .compare-table{
            text-align: right;
        }
        .compare-table td:not(:first-child){
            width: 200px !important;
        }
    </style>
@endsection

@section('content')
    <section id="compare-section" class="section estate-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row compare-box-header">
                        <div style="width: 120px"></div>
                        @foreach($ads as $ad)
                            <div class="compare-item col">
                                <a class="img-link" href="{{ route('adv.show', $ad->id) }}">
                                    <img class="compare-image img-fluid" src="{{ $ad->thumbnail }}" alt="{{ $ad->title }}">
                                </a>
                                <div>
                                    <p class="compare-title">{{ $ad->title }}</p>
                                </div>
                                <a class="compare-estate-link" href="#">
                                    @if($ad->real_estate->image)
                                        <img class="compare-estate-image img-fluid" src="{{ $ad->thumbnail }}" alt="{{ $ad->title }}">
                                    @endif
                                </a>
                                <div>
                                    <p class="compare-price">{{ $ad->sell }} تومان</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row compare-box-body">
                        <div class="col-12 compare-box-title">
                            <p>مشخصات کلی</p>
                        </div>
                        <div class="col-12 compare-table">
                            <div class="row">
                                <div class="compare-td-header">متراژ</div>
                                @foreach($ads as $ad)
                                    <div class="col compare-td">{{ $ad->area }}</div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="compare-td-header">سن</div>
                                @foreach($ads as $ad)
                                    <div class="col compare-td">{{ $ad->age }}</div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="compare-td-header">تعداد اتاق</div>
                                @foreach($ads as $ad)
                                    <div class="col compare-td">{{ $ad->room }}</div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="compare-td-header">نوع معامله</div>
                                @foreach($ads as $ad)
                                    <div class="col compare-td">
                                        @if($ad->advertise_type == \App\Advertise::TYPE_FOR_SELL)
                                            فروشی
                                        @else
                                            رهن و اجاره
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="compare-td-header">نوع ملک</div>
                                @foreach($ads as $ad)
                                    <div class="col compare-td">{{ $ad->estate_type->title }}</div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="compare-td-header">تعداد طبقات</div>
                                @foreach($ads as $ad)
                                    <div class="col compare-td">{{ $ad->floor }}</div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="compare-td-header">تعداد واحد در هر طبقه</div>
                                @foreach($ads as $ad)
                                    <div class="col compare-td">{{ $ad->unit }}</div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="compare-td-header">طبقه واحد ملک</div>
                                @foreach($ads as $ad)
                                    <div class="col compare-td">{{ $ad->in_floor }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 compare-box-title">
                            <p>امکانات</p>
                        </div>
                        <div class="col-12 compare-table">
                            <div class="row">
                                <div class="compare-td-header">آسانسور</div>
                                @foreach($ads as $ad)
                                    <div class="col compare-td">
                                        @if($ad->has_elevator == true)
                                            <i class="fal fa-check-circle"></i>
                                        @else
                                            <i class="fal fa-times-circle"></i>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="compare-td-header">پارکینگ</div>
                                @foreach($ads as $ad)
                                    <div class="col compare-td">
                                        @if($ad->has_parking == true)
                                            <i class="fal fa-check-circle"></i>
                                        @else
                                            <i class="fal fa-times-circle"></i>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            @foreach($properties as $p)
                                <div class="row">
                                    <div class="compare-td-header">{{ $p->title }}</div>
                                    @foreach($ads as $ad)
                                        <div class="col compare-td">
                                            @if(in_array($p->id, $ad->properties()->get()->toArray()))
                                                <i class="fal fa-check-circle"></i>
                                            @else
                                                <i class="fal fa-times-circle"></i>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <link rel="stylesheet" href="{{ asset('js/all.min.js') }}">
@endsection
