<div class="wrapper" id="app">
    <div id="content" class="content">
        <header id="header" class="header">
            <div class="container">

            <nav style="direction:rtl!important; text-align:right!important;" class="navbar navbar-expand-lg primary-nav">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-navbar" aria-controls="primary-navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- <div class="d-none d-sm-none d-md-block">
                    <ul class="primary-menu">
                        <li><a href="{{ route('home') }}">خانه</a></li>
                        <li><a href="{{ route('realestate.index') }}">مشاوران املاک</a></li>
    {{--                            <li><a href="#">مشاوران املاک</a></li>--}}
                    </ul>
                </div> -->
                <a class="navbar-brand" href="{{ route('home') }}"><img class="logo-img" src="/images/main/icon.png" alt="logo"></a>

                <div class="collapse navbar-collapse" id="primary-navbar">

                    <ul class="primary-menu navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active"><a class="nav-link" href="{{ route('home') }}">خانه</a></li>
                        @if(!\Illuminate\Support\Facades\Auth::user())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">ورود مشاوران املاک</a>
                        </li>
                        @endif
                        @if(\Illuminate\Support\Facades\Auth::user())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.advertise.index') }}">املاک من</a>

                        </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">@csrf <button style="cursor: pointer; margin-top: 8px;" class="dropdown-item" href="#"><i class="fas fa-sign-out"></i> خروج</button></form>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>



                <!-- <nav class="navbar primary-nav">
                    <div class="navbar-header">
                        <a href="{{ route('home') }}" class="navbar-brand">
                            <img class="logo-img" src="/images/main/icon.png" alt="logo">
                        </a>
                    </div>
                    <div class="d-none d-sm-none d-md-block">
                        <ul class="primary-menu">
                            <li><a href="{{ route('home') }}">خانه</a></li>
                            <li><a href="{{ route('realestate.index') }}">مشاوران املاک</a></li>
{{--                            <li><a href="#">مشاوران املاک</a></li>--}}
                        </ul>
                    </div>
                </nav>
                <div class="ads-menu-btn-box">
                    @if(Auth::user())
                        <div class="home-profile-box">
                            <a href="#" class="dropdown-toggle home-profile" data-toggle="dropdown">
                                <img class="img-responsive home-profile-img" src="{{ Auth::user()->avatar ? Auth::user()->avatar : url('/images/dashboard/avatar.png') }}">
                            </a>
                            <div class="dropdown-menu home-profile-dropdown">
                                <a class="dropdown-item" href="{{ route('dashboard.advertise.index') }}"><i class="fas fa-user"></i> پنل کاربری</a>
                                <form action="{{ route('logout') }}" method="POST">@csrf <button style="cursor: pointer;" class="dropdown-item" href="#"><i class="fas fa-sign-out"></i> خروج</button></form>
                            </div>
                        </div>
                    @else
                        <a href="/login?next=home" class="btn login-reg-btn d-none d-sm-none d-md-block" id="login-reg-btn">
                            ورود / عضویت <i class="fas fa-sign-in-alt rotate-90-deg"></i>
                        </a>
                    @endif
                    --><a style="margin-top: 20px;" href="{{ Auth::user() ? route('dashboard.advertise.create') : route('advertise.escrow.create') }}" class="btn btn-danger add-ads">
                        <span>ثبت آگهی</span><i class="fas fa-plus-circle add-ads-icon"></i>
                    </a>
                    <button class="btn d-inline-block d-sm-inline-block d-md-none" type="button" id="sidebar-menu-btn"
                            onclick="openNav();openOffcanvas()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            <div class="clearfix"></div>
        </header>
        @yield('content')
    </div>
</div>
