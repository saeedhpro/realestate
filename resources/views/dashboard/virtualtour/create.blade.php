@extends('dashboard.dashboardlayout');

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
    <style>
        .vs__actions {
            left: 10px !important;
            position: absolute !important;
            top: 28% !important;
            text-align: right !important;
        }
        #user-avatar{
            width: 150px;
            display: block;
        }
        #user-avatar + button{
            margin: 13px;
        }
        .user-avatar{
            margin-bottom: 10px;
        }
    </style>
    <style>
        .form-control, .select2-selection{
            height: 2.5rem !important;
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff !important;
            background-clip: padding-box;
            border: 1px solid #ced4da !important;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            text-align: right !important;
            direction: rtl !important;
        }
        .select2-container{
            max-width: 100%;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            left: 1px !important;
            right: unset !important;
            bottom: 0 !important;
            height: unset !important;
        }
        .select2-results{
            text-align: right !important;
            direction: rtl !important;
        }
        #map{
            width: 100%;
            height: 400px;
        }
        #submit-box{
            display: flex;
            justify-content: flex-end;
            width: 100%;
        }
        #submit{
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
            padding: 18px 50px;
        }
        .form-group .bmd-label-static {
            position: unset;
        }
        .select2-dropdown.select2-dropdown--below, .select2-dropdown.select2-dropdown--above{
            overflow-y: scroll;
            max-height: 250px !important;
        }
        textarea.form-control{
            height: auto !important;
        }
    </style>

    <style>
        .switch-input {
            display: none;
        }
        .switch-label {
            position: relative;
            display: inline-block;
            /*min-width: 112px;*/
            cursor: pointer;
            font-weight: 500;
            text-align: right;
            padding: 16px 0 16px 44px;
        }
        .switch-label:before, .switch-label:after {
            content: "";
            position: absolute;
            margin: 0;
            outline: 0;
            top: 50%;
            -ms-transform: translate(0, -50%);
            -webkit-transform: translate(0, -50%);
            transform: translate(0, -50%);
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
        .switch-label:before {
            left: 1px;
            width: 34px;
            height: 14px;
            background-color: #9E9E9E;
            border-radius: 8px;
        }
        .switch-label:after {
            left: 0;
            width: 20px;
            height: 20px;
            background-color: #FAFAFA;
            border-radius: 50%;
            box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.14), 0 2px 2px 0 rgba(0, 0, 0, 0.098), 0 1px 5px 0 rgba(0, 0, 0, 0.084);
        }
        .switch-label .toggle--on {
            display: none;
        }
        .switch-label .toggle--off {
            display: inline-block;
        }
        .switch-input:checked + .switch-label:before {
            background-color: #A5D6A7;
        }
        .switch-input:checked + .switch-label:after {
            background-color: #4CAF50;
            -ms-transform: translate(80%, -50%);
            -webkit-transform: translate(80%, -50%);
            transform: translate(80%, -50%);
        }
        .switch-input:checked + .switch-label .toggle--on {
            display: inline-block;
        }
        .switch-input:checked + .switch-label .toggle--off {
            display: none;
        }

    </style>
    <style>
        .md-checkbox {
            position: relative;
            margin: 1em 0;
            text-align: right;
        }
        .md-checkbox.md-checkbox-inline {
            display: inline-block;
        }
        .md-checkbox label {
            cursor: pointer;
            display: inline;
            line-height: 1.25em;
            vertical-align: top;
            clear: both;
            padding-right: 1px;
        }
        .md-checkbox label:not(:empty) {
            padding-right: 0.75em;
        }
        .md-checkbox label:before, .md-checkbox label:after {
            content: "";
            position: absolute;
            right: 0;
            top: 0;
        }
        .md-checkbox label:before {
            width: 1.25em;
            height: 1.25em;
            background: #fff;
            border: 2px solid rgba(0, 0, 0, 0.54);
            border-radius: 0.125em;
            cursor: pointer;
            transition: background 0.3s;
        }
        .md-checkbox input[type=checkbox] {
            outline: 0;
            visibility: hidden;
            width: 1.25em;
            margin: 0;
            display: block;
            float: right;
            font-size: inherit;
        }
        .md-checkbox input[type=checkbox]:checked + label:before {
            background: #337ab7;
            border: none;
        }
        .md-checkbox input[type=checkbox]:checked + label:after {
            transform: translate(0.25em, 0.3365384615em) rotate(-45deg);
            width: 1em;
            height: 0.375em;
            border: 0.125em solid #fff;
            border-top-style: none;
            border-right-style: none;
            right: 5px !important;
        }
        .md-checkbox input[type=checkbox]:disabled + label:before {
            border-color: rgba(0, 0, 0, 0.26);
        }
        .md-checkbox input[type=checkbox]:disabled:checked + label:before {
            background: rgba(0, 0, 0, 0.26);
        }
        .center-box{
            margin: 0 auto !important;
        }
        .show{
            display: block !important;
        }
    </style>
@endsection

@section('content')
    <div>
        <div class="row">
            <div class="col-md-4 offset-1">
                <div class="card card-profile">
                    <div class="card-avatar">
                        <a href="#">
                            <img class="img" src="{{ $advertise->thumbnail }}" />
                        </a>
                    </div>
                    <div class="card-body">
                        <h6 class="card-category text-gray">{{ $advertise->user->name }}</h6>
                        <h4 class="card-title">{{ $advertise->city->name  }} - {{ $advertise->title }}</h4>
                        <p class="card-description">
                            {{  substr($advertise->description , 0 , 200) }}
                        </p>
                        <a href="{{ route('adv.show', $advertise->id) }}" class="btn btn-primary btn-round">مشاهده</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">تور مجازی آگهی کد {{ $advertise->id }}</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf
                            {{--                        <div class="row">--}}
                            {{--                            <div class="col-md-6">--}}
                            {{--                                <div class="form-group">--}}
                            {{--                                    <label for="title" class="bmd-label-static">عنوان</label>--}}
                            {{--                                    <input id="title" type="text" class="form-control">--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="advertise" class="bmd-label-static">آگهی *</label>
                                        <select id="advertise" type="text" class="select2-box form-control">
                                            @foreach($advertises as $a)
                                                <option value="{{ $a->id }}" @if($a->id == $advertise->id) selected @endif>{{ $a->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="path" class="bmd-label-static">نام پوشه *</label>
                                        <input id="path" type="text" class="form-control">
                                        <div id="path_error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="dropzone" class="bmd-label-static">فایب زیپ تور مجازی *</label>
                                        <div id="dropzone" class="dropzone"></div>
                                        <div id="zip"></div>
                                    </div>
                                </div>
                            </div>
                            <button id="storeVrTour" type="submit" class="btn btn-primary pull-right">افزودن تور مجازی</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/dropzone.min.js') }}"></script>

    <script>
        Dropzone.autoDiscover = false;
        $(document).ready(()=>{
            var dropzone = new Dropzone("#dropzone", {
                url: '{{ url('/api/upload/tour') }}',
                maxFilesize: 99999999,
                maxFiles: 1,
                acceptedFiles: ".zip",
                addRemoveLinks: true,
                timeout: 5000,
            });
            dropzone.on("success", function (file, response) {
                $("#zip").html("");
                $(file.previewTemplate).append(`<input type="hidden" value="${response.id}"/>`);
                let zip = `<input id="tour" class="dropzone-tour" type="hidden" value="${response.id}">`;
                $("#path").val(response.title).prop('disabled', true);
                $("#zip").html(zip);
            });
            dropzone.on("removedfile", function (file) {
                var id = $(file.previewTemplate).find('input').val();
                $("#path").val("").prop('disabled', false);
                $("#zip").html('');
                $.ajax({
                    url: '/api/upload/tour/'+id+'/delete',
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
        });
        $(document).ready(()=>{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#path").on('focus', function () {
                $("#path_error").html('');
            });
            $('#storeVrTour').on("click", function(e){
                e.preventDefault();
                let id = $("#tour").val();
                let advertise_id = $("#advertise").val();
                let path = $("#path").val();
                if(!path){
                    $("#path_error").html(`<div style="font-size: 11px; color: #f44336;" role="alert">نام پوشه نمی تواند خالی باشد!</div>`);
                    return;
                }
                $.post({
                    url: '{{ route('dashboard.advertise.vrtour.store', $advertise->id) }}',
                    '_token': '{{ csrf_token() }}',
                    data: {
                        id: id,
                        advertise_id: advertise_id,
                        path: path
                    },
                    success: (response) => {
                        console.log(response.id);
                    },
                    error: (error) => {
                        alert('متاسفانه خطایی رخ داده است!');
                    }
                });

            });
            $('#advertise').on('change', ()=>{
                let id = $('#advertise').val();
                location.replace('/dashboard/advertise/'+id+'/vrtour');
            });
        });
    </script>
@endsection
