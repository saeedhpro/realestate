
<footer id="footer">
    <div id="main-footer">
        <div class="show-all-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <h2 class="show-all-h2">تمامی املاک سایت <a class="site-link" href="#">مشاور املاک ما</a> را در این قسمت مشاهده نمایید</h2>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <a href="/search?st=all" class="btn btn-danger btn-block btn-lg mr-auto show-all-btn"><i class="fa fa-home"></i> مشاهده تمام املاک</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="inner-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12 first mr-right">
                        <div class="widget">
                            <div class="widget-title">
                                <h3><i class="fa fa-link"></i> لینک ها</h3>
                                <hr>
                            </div>
                            <ul class="custom-list">
                                <li><a title="" href="#"> - پشتیبانی</a></li>
                                <li><a title="" href="#"> - در باره ما</a></li>
                                <li><a title="" href="#"> - تماس با ما</a></li>
                                <li><a title="" href="#"> - شرایط و قوانین</a></li>
                                <li><a title="" href="#"> - حق کپی رایت</a></li>
                                <li><a title="" href="#"> - به ما بپیوندید</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 first mr-right">
                        <div class="widget">
                            <div class="widget-title">
                                <h3><i class="fa fa-home"></i> درباره ما</h3>
                                <hr>
                            </div>
                            <p>
                                لورم ایپسوم یک متن بی مفهوم استاندارد است که برای پرکردن صفحات وب توسط طراحان به کار می رود. لورم ایپسوم یک متن بی مفهوم استاندارد است که برای پرکردن صفحات وب توسط طراحان به کار می رود.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 col-xs-12 first mr-right">
                        <div class="widget">
                            <div class="widget-title">
                                <h3><i class="fa fa-envelope"></i> خبرنامه سایت</h3>
                                <hr>
                            </div>
                            <p>
                                برای آگاهی از اخبار و اطلاعیه های سایت ایمیل خود را در این قسمت وارد نمایید
                            </p>
                            <form class="form-inline" id="news-reg-form" role="form">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="news-reg-input" placeholder="ایمیل خود را وارد کنید">
                                </div>
                                <button type="submit" class="btn btn-danger news-reg-btn">عضویت</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="copy-right">
        <div class="container">
            <p class="text-right" style="padding: 10px; float: right">
                طراحی شده توسط <a href="https://SaeedHeydari.ir">سعید حیدری</a>
            </p>
            <p class="text-right" style="padding: 10px; float: left">
                کلیه ی حقوق مادی و معنوی متعلق به <a href="#">املاک ما </a> می باشد. <i class="fas fa-copyright"></i> All rights reserved
            </p>
            <div class="clearfix"></div>
        </div>
    </div>
</footer>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

@yield('scripts')

</body>
</html>
