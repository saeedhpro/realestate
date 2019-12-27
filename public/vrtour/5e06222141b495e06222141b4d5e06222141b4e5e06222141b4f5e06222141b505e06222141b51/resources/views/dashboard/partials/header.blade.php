<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8" />
    {{--    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">--}}
    {{--    <link rel="icon" type="image/png" href="../assets/img/favicon.png">--}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        داشبورد
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'
    />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/google-fonts.css') }}"
    />
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">

    <link href="{{ asset('css/dashboard/cairo.css') }}" rel="stylesheet">

    <link href="{{ asset('css/dashboard/material-dashboard.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/dashboard/material-dashboard-rtl.css') }}" rel="stylesheet" />

    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4 {
            font-family: "Cairo";
        }
    </style>
    @yield('styles')
</head>

<body>
<div class="wrapper">
    @include('dashboard.partials.sidebar')
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        @if($user->type == \App\User::ADMIN)
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="vrtourDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">notifications</i>
                                <span class="notification">{{ count($vrads) }}</span>
                                <p class="d-lg-none d-md-block">
                                    تورهای مجازی
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="vrtourDropdown">
                                @foreach($vrads as $v)
                                    <a class="dropdown-item" href="{{ route('dashboard.advertise.vrtour.create', $v->id) }}">{{ $v->title }}</a>
                                @endforeach
                            </div>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    حساب کاربری
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit', $user->id) }}">پروفایل</a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button style="cursor: pointer; width: 94%;" class="dropdown-item">خروج</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
