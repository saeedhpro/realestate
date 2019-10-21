<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
    <link href='{{ asset('css/bootstrap.min.css') }}' rel='stylesheet'/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @yield('styles')


</head>
<body>

