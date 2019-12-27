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
                                    <p style="font-size: 13px" class="address">({{ $adv->city->name }}) - {{ $adv->address }}</p>
                                    <p style="font-size: 13px" class="address"><span>اتاق: {{ $adv->room }}</span> -  <span>متراژ: {{ $adv->area }} متر</span> </p>
                                    @if($adv->advertise_type == \App\Advertise::TYPE_FOR_SELL)
                                        <div>
                                            <p style="font-size: 13px; left: 15px" class="btn-danger alerted">
                                                {{ \App\Advertise::normalPrice($adv->sell / $adv->area, $adv->area, $adv->age, 1, $adv->in_floor, $adv->floor, $adv->unit * $adv->floor, $adv->has_elevator == true, $adv->has_parking == true)  }}
                                            </p>
                                        </div>
                                    @endif
                                    {{--                                                {{ $adv->priceLevel() }}--}}
                                    <p style="font-size: 13px" class="address">
                                        {{ $adv->advertise_type == \App\Advertise::TYPE_FOR_SELL ? 'قیمت: ' . $adv->sell . 'تومان' : 'رهن: ' . $adv->sell . 'تومان' . ' - اجاره: ' . $adv->sell . 'تومان' }}
                                    </p>
                                    <div>
                                        <div class="form-group compare-chk-box">
                                            <input type="checkbox" id="compare-{{$adv->id}}" ref="compare-{{$adv->id}}" v-model="compares" @change="compareChk({{ $adv->id }})" value="{{ $adv->id }}" class="compare-chk">
                                            <label for="compare-{{$adv->id}}" class="compare-label text-danger">مقایسه</label>
                                        </div>
                                    </div>
                                    <p style="font-size: 13px" class="address res">{{ $adv->real_estate->name }}</p>
                                    {{--                                                <div class="progress-bar" aria-valuemax="70" style="height: 25px;"></div>--}}
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
