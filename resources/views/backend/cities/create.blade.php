@extends('layouts.backend')

@section('content')

    <main>

        <section class="search_interactive">

            <div class="container">

                <a href="#" class="scrollup"></a>

                <header>
                    <h1>Dodaj nowe miasto</h1>

                </header>

                <div class="row">

                    <div class="col-sm-12">

                        <form method="POST" action="{{ route('cities.store') }}">
                            <h3>Nazwa</h3>
                            <input class="form-control" type="text"  name="name"><br>
                            <button class="btn btn-primary" type="submit">Utwórz</button>
                            {{ csrf_field() }}

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="ul_errors">
                                        @foreach ($errors->all() as $error)
                                            <li class="czerwone">{{ $error }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </form>

                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection
