<section id="map-section" class="section container-fluid" style="border-bottom: 2px solid rgba(0,0,0,0.5)">
    <div style="position: relative" class="row">
        <div class="col-12 col-sm-4 col-md-4">
            <div class="row">
                <button class="btn btn-danger ml-auto" id="open-filter"
                        data-toggle="collapse" href="#search-form-box"
                        aria-expanded="false" aria-controls="search-form-box"
                >
                    فیلتر <i class="fal fa-filter"></i>
                </button>
                <div class="col-12 col-sm-12 col-md-12 collapse" id="search-form-box">
                    <form @submit.prevent="searchAjax" id="search-form" method="get">
                        <div class="form-row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg">
                                <select v-model="ets" name="ets[]" class="form-control" id="choose-sector-select">
                                    @foreach($estate_types as $ets)
                                        <option value="{{ $ets->id }}">{{ $ets->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg">
                                <select  v-model="st" name="st" class="select2-box form-control" id="choose-type-select">
                                    <option value="all">همه آگهی ها</option>
                                    <option value="buy">فروش</option>
                                    <option value="rent">رهن و اجاره</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg">
                                <input v-model="agefrom" name="age" type="text" id="age-field" class="form-control" placeholder="سال ساخت از">
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg">
                                <input v-model="ageto" name="age" type="text" id="age-field" class="form-control" placeholder="سال ساخت تا">
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg">
                                <input v-model="room" name="room" type="text" id="room-field" class="form-control" placeholder="تعداد اتاق">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg">
                                <input v-model="areafrom" name="areafrom" type="text" id="area-from-field" class="form-control" placeholder="متراژ از">
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg">
                                <input v-model="areato" name="areato" type="text" id="area-to-field" class="form-control" placeholder="متراژ تا">
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg">
                                <input v-model="price_from" name="price-from" type="text" id="price-from-field" class="form-control" placeholder="قیمت از">
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg">
                                <input v-model="price_to" name="price-to" type="text" id="price-to-field" class="form-control" placeholder="قیمت تا">
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg">
                                <button type="submit" class="btn btn-primary search-form-btn" style="height: 41px !important; font-size: .8125rem !important">فیلتر</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row" v-if="home_ads.length > 0">
                <div style="overflow-y: scroll; height: calc(100vh - 210px); width: calc(100% - 13px);" id="adv-box">
                    <div class="col-12" v-for="adv in home_ads">
                        <div class="card home-ads-item" style="width: 100% !important;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-4 col-lg-4 col-md-4">
                                        <img :alt="adv.title" style="width: 100%; border: 1px solid rgba(0,0,0,0.5);" :src="adv.thumbnail">
                                    </div>
                                    <div class="col-12 col-sm-8 col-md-8 col-lg-8" style="text-align: right;">
                                        <a :href="'/adv/' + adv.id" v-text="adv.title"></a>
                                        <p style="font-size: 13px" class="address" v-text="'(' + adv.city.name + ')' + '-' + adv.address"></p>
                                        <p style="font-size: 13px" class="address"><span v-text="'تعداد اتاق:' + adv.room"></span>   -   <span v-text="'متراژ(متر):' + adv.area"></span> </p>
                                        <div v-if="adv.advertise_type == 1">
                                            <p style="font-size: 13px; left: 15px" class="btn-danger alerted" v-text="adv.status"></p>
                                        </div>
                                        <p style="font-size: 13px" class="address" v-text="adv.advertise_type == 1 ? 'قیمت: ' + adv.sell : 'رهن: ' + adv.sell + 'تومان' + ' - اجاره: ' + adv.sell + 'تومان'"></p>
                                        <div>
                                            <div class="form-group compare-chk-box">
                                                <input type="checkbox" :id="'compare-'+adv.id" v-model="compares" @change="compareChk(adv.id)" :value="adv.id" class="compare-chk">
                                                <label :for="'compare-'+adv.id" class="compare-label text-danger">مقایسه</label>
                                            </div>
                                        </div>
                                        <p class="address res" v-text="adv.real_estate.name"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-else>آگهی موجود نیست!</div>

        </div>
        <div class="d-none d-sm-block col-sm-8">
            <div id='map'></div>
        </div>
        <div id="compare-box" class="row">
            <div class="col-5">
                <p>مقایسه</p>
            </div>
            <div class="col-7">
                <a id="compare-link" :href="compares.length > 1 ? compare_url : '#'">
                    <span id="number" v-html="compares.length"></span>
                    <span>عدد</span>
                </a>
            </div>
        </div>

        <div id="compare-ids">
        </div>
    </div>
</section>
