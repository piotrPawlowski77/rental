@extends('layouts.backend')

@section('content')

    <main>

        <section class="search_interactive">

            <div class="container">

                <a href="#" class="scrollup"></a>

                <!-- Informacja z sesjii o komunikatach -->
                @if(\Illuminate\Support\Facades\Session::has('message'))
                    <div class="row">
                        <div class="alert alert-info alert-dismissible fade show col-sm-12 text-center" role="alert">

                            <p>{{ \Illuminate\Support\Facades\Session::get('message') }}</p>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                    </div>
                @endif

                <header>
                    <h1>Miasta <a href="{{ route('cities.create') }}" class="btn btn-success" role="button">Dodaj miasto</a> </h1>

                </header>

                <div class="row">

                    <div class="col-sm-12">

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Nazwa miasta</th>
                                    <th>Edytuj / Dodaj</th>
                                </tr>
                                @foreach($cities as $city)
                                    <tr>
                                        <td>{{ $city->name }}</td>
                                        <td>

                                            <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-info" role="button">Edytuj</a>

                                            <form style="display: inline;" method="post" action="{{ route('cities.destroy', $city->id) }}">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Czy napewno usunąć miasto?');">Usuń</button>

                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection
