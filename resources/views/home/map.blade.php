<section id="map-section" class="section container-fluid" style="border-bottom: 2px solid rgba(0,0,0,0.5)">
    <div class="row">
        <div class="col-12 col-sm-4 col-md-4">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <form id="search-form" method="get">
                        <div class="form-row">
                            <div class="col-12 col-sm-12 col-md">
                                <select name="ets[]" class="form-control" id="choose-sector-select">
                                    @foreach($estate_types as $ets)
                                        <option value="{{ $ets->id }}">{{ $ets->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-12 col-md">
                                <select name="st" class="select2-box form-control" id="choose-type-select">
                                    <option value="all">همه آگهی ها</option>
                                    <option value="buy">فروش</option>
                                    <option value="rent">رهن و اجاره</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-12 col-md">
                                <input name="age" type="text" id="age-field" class="form-control" placeholder="سال ساخت">

                            </div>
                            <div class="col-12 col-sm-12 col-md">
                                <input name="room" type="text" id="room-field" class="form-control" placeholder="تعداد اتاق">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-sm-12 col-md">
                                <input name="areafrom" type="text" id="area-from-field" class="form-control" placeholder="متراژ از">
                            </div>
                            <div class="col-12 col-sm-12 col-md">
                                <input name="areato" type="text" id="area-to-field" class="form-control" placeholder="متراژ تا">
                            </div>
                            <div class="col-12 col-sm-12 col-md">
                                <input name="price-from" type="text" id="price-from-field" class="form-control" placeholder="قیمت از">
                            </div>
                            <div class="col-12 col-sm-12 col-md">
                                <input name="price-to" type="text" id="price-to-field" class="form-control" placeholder="قیمت تا">
                            </div>
                            <div class="col-12 col-sm-12 col-md">
                                <button type="submit" class="btn btn-primary search-form-btn" style="height: 44px !important; font-size: 16px !important">جستجو</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if(count($advertises) > 0)
                <div class="row">
                    <div style="overflow-y: scroll; height: calc(100vh - 210px); width: calc(100% - 13px);" id="adv-box">
                        @foreach($advertises as $adv)
                            <div class="col-12">
                                <div class="card" style="width: 100% !important;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-lg-4 col-md-4">
                                                <img alt="{{ $adv->title }}" style="width: 100%; border: 1px solid rgba(0,0,0,0.5);" src="{{ $adv->thumbnail }}">
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-8 col-lg-8" style="text-align: right;">
                                                <a href="{{ route('adv.show', $adv->id) }}">{{ $adv->title }}</a>
                                                <p style="font-size: 13px" class="address">({{ $adv->city->name }}), {{ $adv->address }}</p>
                                                <p style="font-size: 13px" class="address"><span>اتاق: {{ $adv->room }}</span> -  <span>متراژ: {{ $adv->area }} متر</span> </p>
                                                @if($adv->advertise_type == \App\Advertise::TYPE_FOR_SELL)
                                                    <div>
                                                        <p style="font-size: 13px" class="address"> <p style="font-size: 13px" class="btn-danger alerted">
                                                            {{ \App\Advertise::normalPrice($adv->sell / $adv->area, $adv->area, $adv->age, 1, $adv->in_floor, $adv->floor, $adv->unit * $adv->floor, $adv->has_elevator == true, $adv->has_parking == true)  }}
                                                        </p>
                                                    </div>
                                                @endif
{{--                                                {{ $adv->priceLevel() }}--}}
                                                <p style="font-size: 13px" class="address">
                                                    {{ $adv->advertise_type == \App\Advertise::TYPE_FOR_SELL ? 'قیمت: ' . $adv->sell . 'تومان' : 'رهن: ' . $adv->sell . 'تومان' . ' - اجاره: ' . $adv->sell . 'تومان' }}
                                                </p>
                                                <p style="font-size: 13px" class="address res">{{ $adv->real_estate->name }}</p>
                                                <div class="progress-bar" aria-valuemax="70" style="height: 25px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p>آگهی موجود نیست</p>
            @endif
        </div>
        <div class="d-none d-sm-block col-sm-8">
            <div id='map'></div>
        </div>
    </div>
</section>
