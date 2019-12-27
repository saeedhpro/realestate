@extends('dashboard.dashboardlayout');

@section('styles')
<link rel="stylesheet" href="{{ asset('css/intl.tel.input.min.css') }}">
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
    .mobile-input{
        width: 100%;
        border: none;
        padding-left: 35px;
    }
    .mobile-input:focus{
        outline: none;
    }
    .iti-flag {
        background-image: url({{ asset('/images/tel-flags/flags.png') }});
    }
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
        .iti-flag {background-image: url({{ asset('/images/tel-flags/flags@2x.png') }});}
    }
    .intl-tel-input{
        direction: ltr;
        height: 40px;
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .intl-tel-input .selected-flag .iti-flag{
        left: 10px;
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
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">ویرایش مشارو املاک {{ $realestate->name }}</h4>
                    {{-- <p class="card-category">Complete your profile</p> --}}
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Company (disabled)</label>
                                    <input type="text" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Username</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Email address</label>
                                    <input type="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Fist Name</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Last Name</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Adress</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">City</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Country</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Postal Code</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>About Me</label>
                                    <div class="form-group">
                                        <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
                                        <textarea class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="#pablo">
                        <img class="img" src="../assets/img/faces/marc.jpg" />
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-category text-gray">CEO / Co-Founder</h6>
                    <h4 class="card-title">Alec Thompson</h4>
                    <p class="card-description">
                        Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                    </p>
                    <a href="#pablo" class="btn btn-primary btn-round">Follow</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/intl.tel.input.min.js') }}"></script>

    <script>
        Dropzone.autoDiscover = false;
        $(document).ready(()=>{
            var dropzone = new Dropzone("#dropzone", {
                url: '{{ url('/api/upload/') }}',
                maxFilesize: 150,
                maxFiles: 1,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 5000,
            });
            dropzone.on("success", function (file, response) {
                $(file.previewTemplate).append(`<input type="hidden" value="${response.id}"/>`);
                let image = `<input id="image-${response.id}" class="dropzone-images" v-model="images" type="hidden" value="${response.id}">`;
                $("#images").append(image);
            });
            dropzone.on("removedfile", function (file) {
                var id = $(file.previewTemplate).find('input').val();
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
        });
        $(document).ready(()=>{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#delete-avatar").on('click', (e) => {
                e.preventDefault();
                $.post({
                    url: '',
                    '_token': '{{ csrf_token() }}',
                    success: (response) => {
                        $('#user-avatar').src = '';
                    },
                    error: (error) => {
                        alert('متاسفانه خطایی رخ داده است!');
                    }
                });
            });
            $('#storeEmployee').on("click", function(e){
                e.preventDefault();
                let name = $("#name").val();
                let email = $("#email").val();
                let password = $("#password").val();
                let password_confirmation = $("#password-confirm").val();
                let phone = $("#mobile-input").val();
                let address = $("#address").val();
                let tmps = $(".dropzone-images");
                let images = [];
                for(var i = 0; i < tmps.length; i++){
                    images.push($(tmps[i]).val());
                }
                $.post({
                    url: '',
                    '_token': '{{ csrf_token() }}',
                    data: {
                        name: name,
                        email: email,
                        password: password,
                        password_confirmation: password_confirmation,
                        phone: phone,
                        address: address,
                        images: images,
                        real_estate_id: '{{ $user->real_estate->id }}'
                    },
                    success: (response) => {
                        alert(response.message);
                        console.log(response);
                    },
                    error: (error) => {
                        alert('متاسفانه خطایی رخ داده است!');
                    }
                });

            });
        });
        $(document).ready(function () {
            const mobileinput = document.querySelector("#mobile-input");

            var iti = window.intlTelInput(mobileinput, {
                utilsScript: "{{ asset('js/telutils.js') }}",
                initialCountry: "ir",
            });
            iti.setNumber('{{ $realestate->phone }}');

            var errorMap = ["شماره تلفن نادرست است", "کد کشور نادرست است", "شماره ی وارد شده بسیار کوتاه است", "شماره ی وارد شده بسیار طولانی است", "شماره درست را وارد کنید!"];

            $("#mobile-input").on('blur', function () {
                reset();
                if(iti.isValidNumber()){
                    $("#truephone").val(true);
                } else {
                    var errorCode = iti.getValidationError();
                    $("#telerror").html(errorMap[errorCode]);
                    $("#truephone").val(false);
                }
            });
            function reset() {
                $("#telerror").html("");
                $("#truephone").val(true);
            }
        });

    </script>
@endsection
