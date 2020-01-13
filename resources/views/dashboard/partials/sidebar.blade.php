<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('images/dashboard/sidebar-1.jpg') }}">
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">home</i>
                    <p>صفحه ی اصلی</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('dashboard.advertise.create') }}">
                    <i class="material-icons">add_circle</i>
                    <p>ثبت آگهی</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('dashboard.advertise.index') }}">
                    <i class="material-icons">dashboard</i>
                    <p>آگهی ها</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('dashboard.advertise.search') }}">
                    <i class="material-icons">search</i>
                    <p>جستجو در آگهی ها</p>
                </a>
            </li>
            @if($user->real_estate)
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('dashboard.realestate.employee.create', $user->real_estate) }}">
                        <i class="material-icons">person_add</i>
                        <p>افزودن کارمند</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('dashboard.realestate.employee.index', $user->real_estate) }}">
                        <i class="material-icons">people_alt</i>
                        <p>لیست کارمندان</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('realestate.show', $user->real_estate) }}">
                        <i class="material-icons">home_work</i>
                        <p>مشاور املاک</p>
                    </a>
                </li>
            @endif
            @if($user->type == \App\User::ADMIN)
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('realestate.index') }}">
                        <i class="material-icons">list_alt</i>
                        <p>لیست مشاوران املاک</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('dashboard.settings.edit') }}">
                        <i class="material-icons">settings</i>
                        <p>تنظیمات سایت</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
