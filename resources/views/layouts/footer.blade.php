<footer id="myFooter">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h2 class="logo"><a href="{{ route('home') }}"> Car Rental </a></h2>
            </div>
            <div class="col-sm-2">
                <h5>Start</h5>
                <ul>
                    <li><a href="{{ route('home') }}">Strona główna</a></li>
                    <li><a href="{{ route('login') }}">Zaloguj się</a></li>
                    <li><a href="{{ route('register') }}">Rejestracja</a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <h5>O nas</h5>
                <ul>
                    <li><a href="{{ route('about') }}">O firmie</a></li>
                    <li><a href="{{ route('contact') }}">Kontakt</a></li>
                    <li><a href="{{ route('opinions') }}">Opinie</a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <h5>Pomoc</h5>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Dział pomocy</a></li>
                    <li><a href="#">Forum</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <div class="social-networks">
                    <a href="http://twitter.com" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="http://facebook.com" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="http://plus.google.com" target="_blank" class="google"><i class="fa fa-google-plus"></i></a>
                </div>
                <button type="button" onclick="window.location.href='{{ route('contact') }}'" class="btn btn-default">Kontakt z nami</button>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p> &copy; 2020 Wszelkie prawa zastrzeżone </p>
    </div>
</footer>
