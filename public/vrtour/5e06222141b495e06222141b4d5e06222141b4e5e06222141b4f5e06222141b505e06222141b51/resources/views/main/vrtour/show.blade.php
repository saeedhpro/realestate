<doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>نمای مجازی آگهی {{ $tour->advertise->title }}</title>
    <link href='{{ asset('css/bootstrap.min.css') }}' rel='stylesheet'/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <style>
        html,body, #vrtour{
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'irsans', 'yekan', 'zar';
        }
        #vrtour{
            position: relative;
        }
        #estate-box{
            position: absolute;
            background: rgba(255, 255, 255, 0.7);
            text-align: right;
            direction: rtl;
            top: 10px;
            right: 10px;
            box-shadow: 0px 0px 14px 2px rgba(0,0,0, .4);
            border-radius: 5px;
        }
        #estate-box #top{
            background: #fff;
            padding: 10px 15px;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
        }
        #estate-box #estate-main{
            padding: 10px 15px;
        }
        p, a{
            font-size: 13px !important;
        }
        a{
            padding: 13px !important;
        }
        #realestate-logo{
            position: absolute;
            top: 15px;
            left: 15px;
        }
        #realestate-logo a, #estate-back a{
            padding: 0 !important;
        }
        #estate-back a{
            color: #dc3545 !important;
        }
        #realestate-logo img{
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>

<div id="vrtour">
    <div id="realestate-logo">
        <a href="#">
            <img src="{{ asset($realestate->image) }}" alt="{{ $realestate->name }}">
        </a>
    </div>
    <div id="estate-box">
        <div id="top">
            <span id="estate-id">آگهی شماره ی # {{ $tour->advertise->id }} </span>
            <span id="estate-back" class="left"><a href="{{ route('adv.show', $tour->advertise->id) }}"> <i class="fas fa-chevron-double-left"></i> </a></span>
        </div>
        <div id="estate-main">
            <p class="p-text">{{ $tour->advertise->real_estate->name }}</p>
            @if($tour->advertise->type == \App\Advertise::TYPE_FOR_SELL)
                <p class="p-text">قیمت: {{ $tour->advertise->sell ? $tour->advertise->sell . 'تومان' : 'رایگان'}}</p>
            @else
                <p class="p-text">رهن: {{ $tour->advertise->sell ? $tour->advertise->sell . 'تومان' : 'رایگان'}}</p>
                <p class="p-text">اجاره: {{ $tour->advertise->rent ? $tour->advertise->rent . 'تومان' : 'رایگان' }}</p>
            @endif
            @if($tour->advertise->area)
            <p class="p-text">زیربنا: {{ $tour->advertise->area }} متر</p>
            @endif
            @if($tour->advertise->address)
                <p class="p-text">آدرس: {{ $tour->advertise->address }}</p>
            @endif
            <a class="btn btn-danger" href="tel:{{ $realestate->phone ? $realestate->phone : '#' }}">با ما تماس بگیرید: {{ $realestate->phone ? $realestate->phone : '' }}</a>
        </div>
    </div>
    <iframe width="100%" height="100%" src="{{ asset( $src ) }}">

    </iframe>
</div>


</body>
</html>
