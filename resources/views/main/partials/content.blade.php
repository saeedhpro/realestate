<div class="wrapper" id="app">
    <div id="content" class="content">
        <header id="header" class="header">
            <div class="container">
                <nav class="navbar primary-nav">
                    <div class="navbar-header">
                        <a href="{{ route('home') }}" class="navbar-brand">
                            <img class="logo-img" src="/images/main/icon.png" alt="logo">
                        </a>
                    </div>
                    <div class="d-none d-sm-none d-md-block">
                        <ul class="primary-menu">
                            <li><a href="#">خانه</a></li>
                            <li><a href="#">مشاوران املاک</a></li>
                            <li><a href="#">وبلاگ</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="ads-menu-btn-box">
                    <div class="home-profile-box">
                        <a href="#" class="dropdown-toggle home-profile" data-toggle="dropdown">
                            <img class="img-responsive home-profile-img" src="1.jpg">
                        </a>
                        <div class="dropdown-menu home-profile-dropdown">
                            <a class="dropdown-item" href="#"><i class="fas fa-user"></i> پروفایل</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-sign-out"></i> خروج</a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger add-ads">
                        <span>ثبت آگهی</span><i class="fas fa-plus-circle add-ads-icon"></i>
                    </button>
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
