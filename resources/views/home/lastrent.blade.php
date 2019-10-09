<?php use App\Advertise; ?>
<section id="last-rent-section" class="section">
    <div class="container">
        <div class="row last-sell-body">
            <div class="col-md-12">
                <h3 class="section-header-right text-right">آخرین های اجاره</h3>
                <div class="owl-carousel">
                    @if(count($rent_advs) > 0)
                        @foreach($rent_advs as $rent)
                        <div class="list-item compact">
                            <a class="list-item-link" href="/adv/{{ $rent->id }}">
                                <img class="list-item-image" src="{{ $rent->thumbnail }}">
                            </a>
                            <span class="listing-compact-title padding-10">
                                        <a href="/adv/{{ $rent->id }}" class="fix-text">{{ $rent->title }}</a>
                                        <span class="text-muted font-13 font-normal block">({{ $rent->city->name }})</span>
                                        <hr class="margin-bottom-10">
                                        <i>رهن: {{ $rent->sell }} تومان</i>
                                        <i>اجاره: {{ $rent->rent }} تومان</i>
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
