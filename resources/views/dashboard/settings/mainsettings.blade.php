<form action="{{ route('dashboard.advertise.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="site-name" class="bmd-label-static">نام سایت <span id="name_error" class="text-danger"></span></label>
                <input id="site-name" value="{{$settings->name}}" type="text" class="form-control" required>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="dropzone" class="bmd-label-static" style="width: 100%; margin-right: 10px; font-size: 16px;">لوگو سایت<span id="logo_error" class="text-danger"></span></label>
                <div class="row">
                    <div class="col-6">
                        <div class="img-box" id="img-box" style="position: relative;">
                            <button id="img-delete" style="background: none; border: none; position: absolute; top: 2px; right: 2px;">
                                <i class="fa fa-times-circle" style="color: red;"></i>
                            </button>
                            <input type="hidden" value="{{ $settings->logo ? $settings->logo->id : '' }}" id="old-logo">
                            @if($settings->logo)
                                <img style="width: 100%; height: 100%;" src="{{ url($settings->logo->path) }}">
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div id="dropzone" class="dropzone"></div>
                        <div id="logo">
                            <input id="logo-id" class="dropzone-images" type="hidden" value="{{$settings->logo ? $settings->logo->id : ''}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="site-mapapi" class="bmd-label-static">Api نقشه<span id="map_error" class="text-danger"></span></label>
                <input id="site-mapapi" value="{{$settings->map_api}}" type="text" class="form-control" required>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="site-newsapi" class="bmd-label-static">Api خبرنامه</label>
                <input id="site-newsapi" value="{{$settings->news_api}}" type="text" class="form-control" required>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="site-admin" class="bmd-label-static">کاربر ادمین<span id="admin_error" class="text-danger"></span></label>
                <select name="site-admin" class="form-control" id="site-admin">
                    @foreach($users as $user)
                        <option @if($user->id == $settings->admin->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="site-state" class="bmd-label-static">استان پیشفرض<span id="state_error" class="text-danger"></span></label>
                <select name="site-state" class="form-control" id="site-state">
                    @foreach($states as $state)
                        <option @if($state->id == $settings->state->id) selected @endif value="{{$state->id}}">{{$state->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="site-city" class="bmd-label-static">شهر پیشفرض<span id="city_error" class="text-danger"></span></label>
                <select name="site-city" class="form-control" id="site-city">
                    @foreach($settings->state->cities as $city)
                        <option @if($city->id == $settings->city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr style="width: 100%; margin-right: 15px; margin-left: 15px;"/>
        <div class="col-12">
            <div class="form-group">
                <label for="site-about" class="bmd-label-static">درباره ما</label>
                <textarea id="site-about" type="text" class="form-control" rows="8" required>{{$settings->about}}</textarea>
            </div>
        </div>
    </div>
    <hr />
    <button id="storeSettings" type="submit" class="btn btn-primary pull-right">ثبت تغییرات</button>
    <div class="clearfix"></div>
</form>
