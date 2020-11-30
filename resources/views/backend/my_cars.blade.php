@extends('layouts.backend')

@section('content')


    <main>

        <section class="search_interactive">

            <div class="container">

                <a href="#" class="scrollup"></a>

                <header>
                    <h1>Moje auta</h1>
                </header>

                <div class="row">

                    <div class="col-sm-12">

                        @foreach($cities as $city)

                            <div class="card bg-light mb-3" style="max-width: 18rem;">
                            <div class="card-header">Miasto {{$city->name}}</div>

                                @foreach($city->cars as $car)

                                    <div class="card-body">
                                        <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                                       <a href="{{ route('carPanel', ['id'=>$car->id]) }}" class="btn btn-info">Edytuj</a> <a href="{{ route('deleteCar', ['id'=>$car->id]) }}" class="btn btn-danger">Usuń</a>

                                    </div>

                                @endforeach

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection
