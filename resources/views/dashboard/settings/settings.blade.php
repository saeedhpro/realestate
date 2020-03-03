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
                                <li class="nav-item">
                                    <a class="nav-link" href="#advsettings" data-toggle="tab">
                                        <i class="material-icons">format_list_numbered_rtl</i> تنظیمات آگهی
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#origins" data-toggle="tab">
                                        <i class="material-icons">map</i> تنظیمات محدوده ها
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                            </ul>
                            <a href="{{ url()->previous() }}" class="back-button mr-auto d-inline-flex">
                                <i class="fas fa-arrow-alt-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                    <div class="tab-pane active" id="settings">
                        @include('dashboard.settings.mainsettings')
                    </div>
                    <div class="tab-pane" id="advsettings">
                        @include('dashboard.settings.advsettings')
                    </div>
                    <div class="tab-pane" id="origins">
                        @include('dashboard.settings.originsettings')
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
        $("#add-region").on("click", (e)=>{
            e.preventDefault();
            swal({
                text: 'عنوان محدوده را وارد کنید!',
                content: "input",
                button: {
                    text: "تایید",
                    closeModal: false,
                },
            }).then((name)=> {
                if (!name) {
                    throw null;
                    return;
                }

                $.post({
                    url: '/region',
                    data: {
                        name: name,
                        city_id: {{ $settings->city->id }}
                    },
                    success: (response) => {
                        swal.stopLoading();
                        swal.close();
                        {{--window.location.replace('{{ route('dashboard.settings.edit') }}')--}}
                    },
                    error: (error) => {
                        console.log(error)
                        swal.stopLoading();
                        // swal.close();
                    }
                });
            })
        });
        $("#add-new-property").on("click", function (e) {
            e.preventDefault();
            let title = $("#new-property").val();
            if(!title){
                $("#title_error").html("عنوان را وارد کنید!");
                return;
            }
            $.post({
                url: '{{ route('property.store') }}',
                data: {
                    title: title,
                },
                success: (response)=>{
                    window.location.replace('{{ route('dashboard.settings.edit') }}');
                },
                error: (error)=>{

                }
            });
        });
    });

    function updateProperty(id) {
        swal({
            text: 'عنوان جدید را وارد کنید!',
            content: "input",
            button: {
                text: "تایید",
                closeModal: false,
            },
        }).then((title)=>{
            if (!title){
                throw null;
                return;
            }
            $.post({
                url: '/property/'+id+'/update',
                type: 'PUT',
                data: {
                    title: title
                },
                success: (response) => {
                    window.location.replace('{{ route('dashboard.settings.edit') }}')
                },
                error: (error) => {
                    swal.stopLoading();
                    swal.close();
                }
            });
        })
    }
    function deleteProperty(id) {
        $.post({
            url: '/property/'+id+'/delete',
            type: 'DELETE',
            data: {
                id: id,
            },
            success: (response) => {
                window.location.replace('{{ route('dashboard.settings.edit') }}');
            },
            error: (error) => {

            },
        });
    }
    </script>

@endsection
