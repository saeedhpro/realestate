<div class="tab-pane" id="regions">
    <form action="{{ route('dashboard.advertise.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4">
                <div class="form-group">
                    <label for="region-state" class="bmd-label-static">انتخاب استان<span id="admin_error" class="text-danger"></span></label>
                    <select name="region-state" class="form-control" id="region-state">
                        @foreach($states as $state)
                            <option @if($state->id == $settings->state->id) selected @endif value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4">
                <div class="form-group">
                    <label for="region-city" class="bmd-label-static">انتخاب شهر<span id="city_error" class="text-danger"></span></label>
                    <select name="region-city" class="form-control" id="region-city">
                        @foreach($settings->state->cities as $city)
                            <option @if($city->id == $settings->city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4">
                <div class="form-group">
                    <button class="btn btn-primary" id="add-region">
                        <i class="fas fa-plus fa-2x"></i>
                    </button>
                </div>
            </div>
        </div>
        <hr />
        <div class="clearfix"></div>
    </form>
</div>
