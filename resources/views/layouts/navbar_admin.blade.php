<header>

    <nav class="navbar navbar-dark bg-success navbar-expand-xl">

        <a class="navbar-brand" href="{{ route('home') }}"> <i class="icon-home-outline d-inline-block mr-1 align-bottom logo_serwisu"></i> Car Rental </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainmenu">

            <!--Left side of navbar-->
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('adminHome') }}"> Twoje rezerwacje </a>
                </li>

                @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['admin']))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('myCars') }}"> Lista samochodów </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('carPanel') }}"> Dodaj samochód </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cities.index') }}"> Miasta </a>
                    </li>
                @endif

            </ul>

            <!--Right side of navbar-->
            <ul class="navbar-nav ml-auto">

                <!-- notification envelope -->
                <li class="nav-item dropdown no_a_decoration">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                        <span id="app-notification-count" class="button_mark">4</span>

                        <span class="fa fa-envelope"></span>

                    </a>

                    <!-- notification list dropdown -->
                    <ul id="app-notification-list" class="dropdown-menu notification_list">
                        <li><a href="#"> Lorem ipsum dolor .......... </a></li>
                        <li><a href="#"> Lorem ipsum dolor2 .......... </a></li>
                        <li class="unread_notification"><a href="#"> Lorem ipsum dolor3 ......... </a></li>
                        <li><a href="#"> Lorem ipsum dolor4 .......... </a></li>
                        <li class="unread_notification"><a href="#"> Lorem ipsum dolor5 ......... </a></li>
                    </ul>

                </li>

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

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}"> Twój profil </a>
                    </li>

                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->FullName }} <span class="caret"></span>
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



