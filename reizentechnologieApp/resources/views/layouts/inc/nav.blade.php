<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span id="toggle" class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                
                @foreach( \App\Models\Page::visibleMenuItems() as $menuItem)
                    <li class="nav-item"><a class="nav-link" href='/page/{{$menuItem['name']}}'>{{$menuItem['name']}}</a></li>
                @endforeach
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                @if(Auth::check())
                    @if(Auth::user()->role == 'guide' or Auth::user()->role == 'admin' or Auth::user()->role == 'traveller')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="personalDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Mijn reis
                            </a>
                            <div class="dropdown-menu" aria-labelledby="personalDropdown">
                                @if(Auth::user()->isOrganizer())
                                <a class="dropdown-item" href="{{ route('partisipantslist') }}">Reizigers</a>
                                    @if(Auth::user()->role!='admin')
                                    <a class="dropdown-item" href="{{ route('composeemail') }}">Verstuur mail</a>
                                    @endif
                                <a class="dropdown-item" href="{{ route('paymentslist') }}">Betalingen</a>                              
                                <a class="dropdown-item" href="{{ route('info') }}">Algemene info</a>
                                <a class="dropdown-item" href="{{ route('dayplanning') }}">DayPlanning</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('home') }}">Hotels</a>
                                <a class="dropdown-item" href="{{ route('home') }}">Auto's</a>
                            </div>
                        </li>
                    @endif
                @endif
            </ul>
            <ul class="navbar-nav">
                @if(Auth::check())
                    @if(Auth::user()->role == 'guest')
                        <li class="nav-item"><a class="nav-link" href="{{ route('registerTripMessage') }}">Registreren</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Afmelden</a></li>
                    @else
                        @if(Auth::user()->role == 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">AdminPanel</a></li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Profiel
                            </a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            @if(Auth::user()->role != 'admin')
                                @if(Auth::user()->role != 'guest')
                                    <a class="dropdown-item" href="{{ route('profile') }}">Mijn gegevens</a>
                                    <div class="dropdown-divider"></div>
                                @endif
                            @endif
                                <a class="dropdown-item" href="{{ route('logout') }}">Afmelden</a>
                            </div>
                        </li>
                    @endif
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('log') }}">Inloggen</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

