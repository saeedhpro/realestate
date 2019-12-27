<section id="last-sell-section" class="section">
    <div class="container">
        <div class="row last-sell-body">
            <div class="col-md-12">
                <h3 class="section-header-right text-right">آخرین های فروش</h3>
                <div class="owl-carousel">
                    @if(count($sell_advs) > 0)
                        @foreach($sell_advs as $sell)
                            <div class="list-item compact">
                                <a class="list-item-link" href="/adv/{{ $sell->id }}">
                                    <img class="list-item-image" src="{{ $sell->thumbnail }}">
                                </a>
                                <span class="listing-compact-title padding-10">
                                        <a href="/adv/{{ $sell->id }}" class="fix-text">{{ $sell->title }}</a>
                                        <span class="text-muted font-13 font-normal block">({{ $sell->city->name }})</span>
                                        <hr class="margin-bottom-10">
                                        <i>قیمت: {{ $sell->sell }} تومان</i>
                                    </span>
                            </div>
                        @endforeach
                    @else
                        <div><p>آگهی موجود نیست</p></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
