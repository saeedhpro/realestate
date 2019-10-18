@extends('mainlayout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/intl.tel.input.min.css') }}">
    <style>
        /* Start Login and Register Styles*/
        .sign-box{
            padding-top: 96px;
            direction: rtl;
            color: #fff;
            font-family: 'irsans','yekan','zar';
            background: url({{ asset('/images/main/login-bg.jpg') }}) no-repeat fixed;
            background-size: 100% 100vh;
        }
        .sign-panel{
            background: #fff;
            padding: 25px 20px;
            font-family: 'irsans','yekan','zar';
        }
        .nav-tabs{
            border-bottom: none;
        }
        .nav-tabs .nav-link{
            border: none;
            border-radius: 0;
            color: #fff;
        }
        .nav-tabs .nav-item{
            width: 100%;
        }
        .nav-tabs .nav-item:nth-child(1){
            background: #dc3545;
        }
        .nav-tabs .nav-link.active{
            color: #fff;
            box-shadow: 0px 0px 2px 2px rgba(0,0,0,.4);
        }
        .panel-body .form-control{
            height: 40px;
        }
        .remember-me-input{
            float: right;
            margin-top: 5px;
            margin-left: 8px;
        }
        .remember-me-label{
            float: right;
        }
        .panel-body .form-check{
            color: #4e4e4e;
            font-size: 12px;
            font-family: 'irsans','yekan','zar';
            float: right;
            width: 100%;
        }
        .panel-body .form-check label{
            color: #000 !important;
            font-size: 14px !important;
        }
        #login-btn{
            width: 100%;
            margin-top: 20px;
            height: 40px;
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
        #register-form label{
            color: #606060;
            font-family: 'irsans','yekan','zar';
            font-size: 12px;
            float: right;
            padding: 5px;
        }
        .checkbox-input{
            float: right;
            margin-top: 8px;
            margin-left: 8px;
        }
        #agent-description{
            height: 10em;
        }
        #register-btn{
            width: 100%;
            margin-top: 20px;
            height: 40px;
        }
        /* End Login and Register Styles*/
    </style>
@endsection

@section('content')
    <section id="sign-box" class="sign-box">
        <div class="container">
            <div class="sign-content">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-5 text-center" style="margin: 100px auto 40px;">
                        <div class="panel sign-panel">
                            <div class="panel-header">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link btn" id="register-form-tab" data-toggle="tab" href="#register-form" role="tab" aria-controls="register-form" aria-selected="true">عضویت</a>
                                    </div>
                                </nav>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="register-form" role="tabpanel" aria-labelledby="register-form-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <form id="register-form" action="" method="POST" role="form">
                                                    <input type="hidden" name="register" id="register" value="register">
                                                    <div class="form-group">
                                                        <input type="text" name="login-fullname" class="form-control" id="login-fullname" placeholder="*نام و نام خانوادگی" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email" name="register-email" class="form-control" id="register-email" placeholder="*ایمیل" required>
                                                        <label>این نام کاربری شما در ihome.ir خواهد بود.</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" name="register-password" class="form-control" id="register-password" placeholder="*پسورد" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" name="register-password-repeat" class="form-control" id="register-password-repeat" placeholder="*تکرار پسورد" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="tel" id="mobile-input" name="mobile-input" class="mobile-input">
                                                        <label>شماره تلفن را با کد ناحیه وارد کنید به عنوان مثال : 989123456789+</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="notrobot-checkbox-input checkbox-input" name="notrobot-checkbox" type="checkbox" id="notrobot-checkbox" required>
                                                            <label class="notrobot-checkbox-label" for="notrobot-checkbox">
                                                                من یک ربات نیستم
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="agree-checkbox-input checkbox-input" name="agree-checkbox" type="checkbox" id="agree-checkbox" required>
                                                            <label class="agree-checkbox-label" for="agree-checkbox">
                                                                <a href="#" title=" شرایط و ضوابط"> من شرایط و مقرارت</a> را خواندم و با آن موافقم
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" id="register-btn" class="btn btn-danger">ورود</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/intl.tel.input.min.js') }}"></script>
    <script>
        var mobileinput = document.querySelector("#mobile-input");
        var iti = intlTelInput(mobileinput);
        iti.setCountry("ir");
    </script>
    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                message: 'Hello Vue!'
            }
        })
    </script>
@endsection

