<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--     width=device-width = sprawia ze szerokość dostępnego miejsca zostanie ustawiona
    zaleznie od szerokosci urzadz. initial-scale=1 = początkowa skala. shrink-to-fit=no = off mechanizm.
    zmniejsz się aby się dopasować -->

    <title>Car Rental - frontend</title>

    <meta name="description" content="Strona firmy wypozyczalni samochodow">
    <meta name="keywords" content="wypożyczalnia, samochody, wypożyczalnia samochodów">
    <meta name="author" content="Piotr Pawłowski">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link rel="stylesheet" href=" {{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/frontend_index.css') }}" type="text/css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fontello.css') }}" type="text/css" />


    <!--	czcionki do footer-a-->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/Footer-with-button-logo.css') }}">

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"> </script>

    <!-- Datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">

    <!-- wyszukiwarka autocomplete na stronie glownej -->
    <script>
        //przypisuje bazowy adres url aplikacji
        var b_url = '{{ url('/') }}';
    </script>


</head>
<body>

    <!--naglowek-->
    @include('layouts.navbar')

    <!--glowny content-->
    @yield('content')

    <!--stopka-->
    @include('layouts.footer')

    <!--skrypty-->
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!--    atrybut integrity pozwoli nie ładować do przeglądarki kodu, który został w jakiś sposób zmanipulowany. a crossorigin jest obecny gdy korzystamy z mechanizmu: CROS (Cross-Origin Resource Sharing) pozwala użyć dod. nagłówki http na stronach  które przestrzegaja zassady same origin. Jeśli tych atrybutow nie bd to nic sie nie stanie.-->

    <!--    skrypt odpowiadający za przyklejanie navbar-a (sticky)-->
    <script src="{{ asset('js/navbar_sticky.js') }}"></script>

    <!--  skrypt odpowiadający za scrollup-a  -->
    <script type="text/javascript" src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/scroll_up.js') }}"></script>

    <!--  walidacja formularza kontaktowego jquery -->
    <script src="{{ asset('js/contact_validation.js') }}"></script>

    <!-- Datepicker -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/datepicker.js') }}"></script>

    <!-- Dołączenie skryptu wyświetlającego dni przekreślone w datepicker w frontend\car_reservation.blade.php -->
    @stack('car_avaiable_dates_script')

</body>
</html>
