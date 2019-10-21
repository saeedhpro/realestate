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
                <a class="nav-link" href="./user.html">
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
            @if($user->real_estate)
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('realestate.show', $user->real_estate) }}">
                        <i class="material-icons">settings</i>
                        <p>تنظیمات مشاور املاک</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('realestate.show', $user->real_estate) }}">
                        <i class="material-icons">person_add</i>
                        <p>افزودن کارمند</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('realestate.show', $user->real_estate) }}">
                        <i class="material-icons">people_alt</i>
                        <p>لیست کارمندان</p>
                    </a>
                </li>
            @endif
            @if($user->type == \App\User::ADMIN)
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('realestate.show', $user->real_estate) }}">
                        <i class="material-icons">settings</i>
                        <p>تنظیمات سایت</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
