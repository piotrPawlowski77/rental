@extends('layouts.frontend')

@section('content')

    <main>

        <section class="search_interactive">

            <div class="container">

                <a href="#" class="scrollup"></a>

                <header>
                    <h1>Wypożycz samochód</h1>
                    <p>Skorzystaj z wielu aut dostępnych w naszej wypożyczalni</p>
                </header>

                <div class="row">

                    <div class="col-sm-12">

                        <form action="#">

                            <div class="form-group">
                                <label class="sr-only" for="city">City</label>
                                <input name="city" value="{{ old('city') }}" type="text" class="form-control autocomplete" id="city" placeholder="City">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="day_in">Check in</label>
                                <input name="check_in" value="{{ old('check_in') }}" type="text" class="form-control datepicker" id="check_in" placeholder="Check in">
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="day_out">Check out</label>
                                <input name="check_out" value="{{ old('check_out') }}" type="text" class="form-control datepicker" id="check_out" placeholder="Check out">
                            </div>

                            <button type="submit" class="btn btn-warning">Search</button>

                            {{ csrf_field() }}

                        </form>

                    </div>

                </div>

            </div>

        </section>

        <section class="cars">

            <div class="container">

                <header>
                    <h1>Dostępne auta</h1>
                </header>

                <div class="row">

                </div>

            </div>

        </section>

    </main>

@endsection
