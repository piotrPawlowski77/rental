@extends('layouts.frontend')

@section('content')

    <main>

        <section class="search_interactive">

            <div class="container">

                <a href="#" class="scrollup"></a>

                <header>
                    <h1>Dostępne samochody</h1>
                </header>

                @foreach( $city->cars->chunk(4) as $chunked_cars )

                    <div class="row">

                        @foreach($chunked_cars as $car)

                            <div class="col-md-3 col-sm-6">

                                <div class="img-thumbnail">

                                    <img class="img-fluid" src="{{ $car->photos->first()->path ?? $imgTmp }}" alt="#">

                                    <div class="car_details">
                                        <h3>Marka: {{ $car->brand }} Model: {{ $car->model }}</h3>
                                        <p>Typ nadwozia: {{ $car->type }}</p>
                                        <p>Silnik: {{ $car->engine }}</p>
                                        <p>Rodzaj paliwa: {{ $car->fuel_type }}</p>
                                        <p>Kolor: {{ $car->color }}</p>
                                        <p>Moc: {{ $car->power }} km</p>
                                        <p>Cena za dzień: {{ $car->price }} zł</p>
                                        <p>Status: {{ $car->status }}</p>
                                        <p> <a href="{{ route('carReservation', ['id' => $car->id]) }}" role="button" class="btn btn-success">Zarezerwuj</a> </p>
                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endforeach

            </div>

        </section>

    </main>

@endsection
