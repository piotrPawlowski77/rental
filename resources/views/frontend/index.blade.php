@extends('layouts.frontend')

@section('content')

    <main>

        <section class="search_interactive">

            <div class="container">

                <a href="#" class="scrollup"></a>

                <header>
                    <h1>Wyszukaj dostępny samochód</h1>
                    <p>Skorzystaj z wielu aut dostępnych w naszej wypożyczalni</p>
                </header>

                <div class="row">

                    <div class="col-sm-12">

                        <form class="form_interactive" action="#">

                            <div class="form-group">
                                <label class="sr-only" for="city">Miasto</label>
                                <input name="city" value="{{ old('city') }}" type="text" class="form-control autocomplete" id="city" placeholder="Miasto">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="check_in">Data odbioru</label>
                                <input name="check_in" value="{{ old('check_in') }}" type="text" class="form-control datepicker" id="check_in" placeholder="Data odbioru">
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="check_out">Data zwrotu</label>
                                <input name="check_out" value="{{ old('check_out') }}" type="text" class="form-control datepicker" id="check_out" placeholder="Data zwrotu">
                            </div>

                            <button type="submit" class="btn btn-warning">Szukaj w bazie</button>

                            {{ csrf_field() }}

                        </form>

                    </div>

                </div>

            </div>

        </section>

        @auth

            <section class="cars">

                <div class="container">

                    <header>
                        <h1>Dostępne auta</h1>
                    </header>

                    <div class="row">

                    </div>

                </div>

            </section>

        @endauth

    </main>

@endsection
