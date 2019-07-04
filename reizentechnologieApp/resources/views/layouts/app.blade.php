<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">

    @yield('styles')

</head>
<body>
    <div class= "fixed-top" style="z-index: 100">
        <div class="d-flex flex-row bg-light">
            <div class="p-2"> <img src="{{ asset('images/ucll_logo.png') }}" class="rounded" alt="logo ucll"></div>
            <div class="d-flex flex-column">
                <div class="p-2"><h1 class="text-danger">TECHNOLOGIE</h1></div>
                <div class="p-2"><h3 class="text-success">internationalisering - studiereizen</h3></div>
            </div>
        </div>
        
        @include('layouts.inc.nav')
       

        @include('cookieConsent::index')

        
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <p class="p-3 mt-3 alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
        @endforeach
    </div>
    <div style="padding-top:200px">
        @yield('content')
    </div>
    
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    @yield('scripts')
</body>
</html>