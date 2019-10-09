<section id="best-real-estate-section" class="section" style="margin-top: 20px;">
    <div class="container">
        <div class="row best-real-estates">
            <div class="col-md-12">
                <h3 class="section-header-right text-right">برترین مشاروان املاک</h3>
                <div class="owl-carousel">
                    @foreach($real_estates as $re)
                    <div class="list-item compact">
                        <a class="list-item-link" href="#">
                            <img class="list-item-image" src="{{ $re->image }}">
                        </a>
                        <span class="listing-compact-title padding-10">
                                    <a href="#" class="fix-text">{{ $re->name }}</a>
                                    <span class="text-muted font-13 font-normal block">({{ $re->city->name }})</span>
                                    <hr class="margin-bottom-10">
                                    <i>مشاهده املاک</i>
                                </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
