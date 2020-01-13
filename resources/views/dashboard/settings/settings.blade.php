@extends('dashboard.dashboardlayout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bs4.min.css') }}">
    <style>
        .bmd-form-group .bmd-label-static{
            left: unset;
            right: 0;
        }
    </style>
@endsection
@section('content')
    <div class="row" style="direction: rtl !important; text-align: right !important;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <span class="nav-tabs-title">تنظیمات: </span>
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#settings" data-toggle="tab">
                                        <i class="material-icons">settings</i> تنظیمات کلی
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="#regions" data-toggle="tab">--}}
{{--                                        <i class="material-icons">map</i> تنظیمات مناطق--}}
{{--                                        <div class="ripple-container"></div>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">
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
                                <button id="storeSettings" type="submit" class="btn btn-primary pull-right">ثبت آگهی</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
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
                                            <button id="add-region">

                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <button id="storeSettings" type="submit" class="btn btn-primary pull-right">ثبت آگهی</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
    Dropzone.autoDiscover = false;
    $(document).ready(function () {
        $("#site-admin").select2({
            theme: 'material'
        });
        $("#site-state").select2({
            theme: 'material'
        });
        $("#site-city").select2({
            theme: 'material'
        });
        $("#region-state").select2({
            theme: 'material'
        });
        $("#region-city").select2({
            theme: 'material'
        });
    });
    $(document).on('change', '#site-state', function () {
        let id = $('#site-state').val();
        $.ajax({url: "/states/"+id+'/cities', success: function(result){
                $.each(result, function (index, city) {
                    $(`<option value="${city.id}">${city.name}</option>`).appendTo('#site-city');
                });
            }});
    });
    $(document).ready(()=>{
        var dropzone = new Dropzone("#dropzone", {
            url: '{{ url('/api/upload/') }}',
            maxFileSize: 150,
            maxFiles: 10,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            capture: "CAMERA"
        });
        dropzone.on("success", function (file, response) {
            $(file.previewTemplate).append(`<input type="hidden" value="${response.id}"/>`);
            $("#logo").html("");
            $("#img-box > img").remove();
            $("#img-box").append(`<img style="width: 100%; height: 100%;" src="${response.path}">`);
            let image = `<input id="logo-id" class="dropzone-images" type="hidden" value="${response.id}">`;
            $("#logo").append(image);
        });
        dropzone.on("error", function (error) {
        });
        dropzone.on("removedfile", function (file) {
            let id = $(file.previewTemplate).find('input').val();
            $.ajax({
                url: '/upload/'+id+'/delete',
                type:'DELETE',
                data:{
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: (response)=>{
                },
                error: (response)=>{
                }
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#img-delete").on("click", function (e) {
            e.preventDefault();
            let id = $("#old-logo").val();
            $.ajax({
                url: '/upload/delete',
                type: 'DELETE',
                '_token': '{{ csrf_token() }}',
                data: {
                    id: id,
                },
                success: (response) => {
                    $("#old-logo").val("");
                    $("#img-box > img").remove();
                    dropzone.removeAllFiles();
                    $("#logo-id").remove();
                },
                error: (error) => {
                    alert('متاسفانه خطایی رخ داده است!');
                    console.log('error', error);
                }
            });
        });
        function validate(){
            let flag = true;
            let name = $("#site-name").val();
            let logo_id = $("#logo-id").val();
            let map_api = $("#site-mapapi").val();
            let admin_id = $("#site-admin").val();
            let state_id = $("#site-state").val();
            let city_id = $("#site-city").val();
            if(!name){
                $("#name_error").html("نام سایت را وارد کنید!");
                flag = false;
            }
            if(!logo_id){
                $("#logo_error").html("لوگو سایت را انتخاب کنید!");
                flag = false;
            }
            if(!map_api){
                $("#map_error").html("Api نقشه را وارد کنید!");
                flag = false;
            }
            if(!admin_id){
                $("#admin_error").html("کاربر ادمین سایت را وارد کنید!");
                flag = false;
            }
            if(!state_id){
                $("#state_error").html("استان پیشفرض را وارد کنید!");
                flag = false;
            }
            if(!city_id){
                $("#city_error").html("شهر پیشفرض را وارد کنید!");
                flag = false;
            }
            return flag;
        }
        $("#storeSettings").on("click", function (e) {
             e.preventDefault();
             if(validate()) {
                 let name = $("#site-name").val();
                 let logo_id = $("#logo-id").val();
                 let map_api = $("#site-mapapi").val();
                 let news_api = $("#site-newsapi").val();
                 let admin_id = $("#site-admin").val();
                 let state_id = $("#site-state").val();
                 let city_id = $("#site-city").val();
                 let about = $("#site-about").val();
                 $.post({
                     url: '{{ route('dashboard.settings.update') }}',
                     '_token': '{{ csrf_token() }}',
                     data: {
                         name: name,
                         logo_id: logo_id,
                         map_api: map_api,
                         news_api: news_api,
                         admin_id: admin_id,
                         state_id: state_id,
                         city_id: city_id,
                         about: about,
                     },
                     success: (response) => {
                         swal("تنظیمات با موفقیت ویرایش شد!", "", "success");
                         window.location.reload();
                     },
                     error: (error) => {
                         alert('متاسفانه خطایی رخ داده است!');
                         // console.log('error', error);
                     }
                 });
             } else {

             }
        });
    });
    </script>

@endsection
