<header>

    <nav class="navbar navbar-dark bg-success navbar-expand-xl">

        <!-- <a class="navbar-brand" href="#"> <img src="img/logo.png" class="d-inline-block mr-1 align-bottom logo_serwisu" alt=""> Motor - Auto serwis </a>-->
        <a class="navbar-brand" href="{{ route('home') }}"> <i class="icon-home-outline d-inline-block mr-1 align-bottom logo_serwisu"></i> Motor - Auto serwis </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainmenu">

            <!--Left side of navbar-->
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}"> Strona główna </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" >O firmie</a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"> O firmie </a>
                        <a class="dropdown-item" href="#"> Opcja 2 </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#"> Opcja 3 </a>
                        <a class="dropdown-item" href="#"> Opcja 4 </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#"> Oferta </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#"> Cennik </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#"> Galeria </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#"> Kontakt </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#"> Komentarze </a>
                </li>

            </ul>

            <!--Right side of navbar-->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Zaloguj się') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Rejestracja') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>

        </div>

    </nav>

</header>



