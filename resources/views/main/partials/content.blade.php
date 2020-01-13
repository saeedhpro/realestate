<div class="wrapper" id="app">
    <div id="content" class="content">
        <header id="header" class="header">
{{--                <nav style="direction:rtl!important; text-align:right!important;" class="navbar navbar-expand-lg primary-nav d-none d-lg-block">--}}
{{--                    <div class="collapse navbar-collapse" id="primary-navbar">--}}
{{--                        <a class="navbar-brand" href="{{ route('home') }}"><img class="logo-img" src="/images/main/icon.png" alt="logo"></a>--}}
{{--                        <ul class="primary-menu navbar-nav">--}}
{{--                            <li class="nav-item active"><a class="nav-link" href="{{ route('home') }}">خانه</a></li>--}}
{{--                            @if(!\Illuminate\Support\Facades\Auth::user())--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ url('/login') }}">ورود مشاوران املاک</a>--}}
{{--                            </li>--}}
{{--                            @endif--}}
{{--                            @if(\Illuminate\Support\Facades\Auth::user())--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('dashboard.advertise.index') }}">املاک من</a>--}}

{{--                            </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <form action="{{ route('logout') }}" method="POST">@csrf <button style="cursor: pointer; margin-top: 8px;" class="dropdown-item" href="#"><i class="fas fa-sign-out"></i> خروج</button></form>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <a href="{{ Auth::user() ? route('dashboard.advertise.create') : route('advertise.escrow.create') }}" class="btn btn-danger add-ads">--}}
{{--                        <span>ثبت آگهی</span><i class="fas fa-plus-circle add-ads-icon"></i>--}}
{{--                    </a>--}}
{{--                </nav>--}}
                <nav style="direction:rtl!important; text-align:right!important; padding: 20px" class="navbar fixed-top navbar-expand-lg primary-nav bg-dark dark">
                    <div class="container" style="padding: 10px">
                        <a class="navbar-brand" href="{{ route('home') }}"><img class="logo-img" src="/images/main/icon.png" alt="logo"></a>
                        <a href="{{ Auth::user() ? route('dashboard.advertise.create') : route('advertise.escrow.create') }}" class="btn btn-danger add-ads d-flex d-lg-none mr-auto">
                            <span>ثبت آگهی</span><i class="fas fa-plus-circle add-ads-icon"></i>
                        </a>
                        <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#primary-navbar" aria-controls="primary-navbar" aria-expanded="false" aria-label="">
                            <i class="fa fa-bars"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="primary-navbar">
                        <ul class="primary-menu navbar-nav">
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
                        <a href="{{ Auth::user() ? route('dashboard.advertise.create') : route('advertise.escrow.create') }}" class="btn btn-danger add-ads d-none d-lg-flex mr-auto">
                            <span>ثبت آگهی</span><i class="fas fa-plus-circle add-ads-icon"></i>
                        </a>
                    </div>
                </nav>
            <div class="clearfix"></div>
        </header>
        @yield('content')
    </div>
</div>
