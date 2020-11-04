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
                                        <h3>{{ $car->brand }} {{ $car->model }}</h3>
                                        <p>{{ $car->type }}</p>
                                        <p>{{ $car->engine }}</p>
                                        <p>{{ $car->fuel_type }}</p>
                                        <p>{{ $car->color }}</p>
                                        <p>{{ $car->power }}</p>
                                        <p>{{ $car->price }}</p>
                                        <p>{{ $car->status }}</p>
                                        <p> <a href="#" role="button" class="btn btn-success">Zarezerwuj</a> </p>
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
