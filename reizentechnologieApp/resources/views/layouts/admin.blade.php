<!doctype html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name')}}</title>
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
        body {
            height: 100vh;
        }
    </style>
     @yield('styles')
</head>
<body>
    <div style="z-index: 100">
        <div class="d-flex flex-row bg-light">
            <div class="p-2"> <img src="{{ asset('images/ucll_logo.png') }}" class="rounded" alt="logo ucll"></div>
            <div class="d-flex flex-column">
                <div class="p-2"><h1 class="text-danger">Administratie - beheer paneel</h1></div>
                <div class="p-2"><h3 class="text-success">internationalisering - studiereizen</h3></div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span id="toggle" class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Frontend</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}"">Afmelden</a></li>
                    </ul>
                </div>
            </div>
        </nav>
  
    <div class="flex-container">
        <div class="d-flex flex-row flex-nowrap py-3" style="height: calc(100vh - 200px);">
            <div class="d-flex flex-column col-auto overflow-auto" id="left">    

                <div class="btn-group-vertical">
                    <a class="btn btn-warning btn_sm btn-block " href="{{ route('home') }}" role="button">Dashboard</a>
                    <a class="btn btn-secondary btn_sm btn-block" href="{{ route('home') }}" role="button">Guest account</a>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            beheer reizen
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                          <a class="dropdown-item" href="{{ route('showtrips') }}">reis beheren</a>
                          <a class="dropdown-item" href="{{ route('dashboard') }}">organistor koppelen</a>
                        </div>
                    </div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            pagina's aanpassen
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                          <a class="dropdown-item" href="{{ route('homePage') }}">home pagina</a>
                          <a class="dropdown-item" href="{{ route('infoPages') }}">info pagina's</a>
                        </div>
                    </div>
                    <a class="btn btn-secondary btn_sm btn-block" href="{{ route('home') }}" role="button">Postcode Toevoegen</a>
                    <a class="btn btn-secondary btn-lg btn-block" href="{{ route('dashboard') }}" role="button">Studierichting toevoegen</a>
                </div>
            </div>
            <div class="d-flex flex-column flex-grow-1 overflow-auto" id="main">
                
                            @yield('content')

            </div>
        </div>
    </div>
    </div>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
@yield('scripts')
</body>
</html>