<section id="search-section" class="section">
    <div class="section-hover"></div>
    <div class="search-box">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-header text-center">جامع ترین وبسایت املاک</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 com-sm-12 col-lg-12 text-center">
                    <div class="search-type-btns text-center">
                        <div class="search-type-box">
                            <span id="for-buy-btn">برای خرید و فروش</span>
                            <span id="for-rent-btn">برای رهن و اجاره</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <form id="search-form" action="/search" method="get">
                                <input id="st" type="hidden" value="buy">
                                <div class="form-row">
                                    <div class="col-12 col-sm-12 col-md">
                                        <select name="state_id" class="form-control" id="choose-state-select">
                                            <option disabled selected>انتخاب استان</option>
                                            @foreach($states as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md">
                                        <select disabled name="city_id" class="form-control" id="choose-city-select">
                                            <option disabled selected>انتخاب شهر</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md">
                                        <select name="ets[]" class="form-control" id="choose-sector-select">
                                            <option disabled selected>نوع کاربری ملک</option>
                                            @foreach($estate_types as $ets)
                                            <option value="{{ $ets->id }}">{{ $ets->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md">
                                        <button type="submit" class="btn btn-primary search-form-btn">جستجو</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>

