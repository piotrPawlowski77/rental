@extends('layouts.backend')

@section('content')


    <main>

        <section class="search_interactive">

            <div class="container">

                <a href="#" class="scrollup"></a>

                <header>
                    <h1>Kalendarz rezerwacji</h1>
                </header>

                <div class="row">

                    <div class="col-sm-12">

                        @foreach($cars as $c=>$car)

                            @push('generate_reservation_calendar_script')
                                <script type="text/javascript">



                                </script>
                            @endpush

                            <h3>Miasto {{ $car->city->name }}</h3>

                            <h4>Samochód {{ $car->brand }} {{ $car->model }}</h4>

                            <div class="col-md-3">
                                <div class="reservationCalendar{{ $c }}"></div>
                            </div>

                            <!-- Dane rezerwacji -->
                            <div class="col-md-9">
                                <div class="reservationData{{ $c }}" style="display: none;">

                                    <div class="table-responsive">

                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Samochód</th>
                                                    <th>Data wypożyczenia</th>
                                                    <th>Data zwrotu</th>
                                                    <th>Użytkownik</th>
                                                    @if( \Illuminate\Support\Facades\Auth::user()->hasRole(['admin']))
                                                        <th>Potwierdź rezerwację</th>
                                                    @endif
                                                    <th>Usuń rezerwację</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="reservation_data_car_name"></td>
                                                    <td class="reservation_data_day_in"></td>
                                                    <td class="reservation_data_day_out"></td>
                                                    <td><a class="reservation_data_person" target="_blank" href=""></a></td>
                                                    @if( \Illuminate\Support\Facades\Auth::user()->hasRole(['admin']) )
                                                        <td><a href="#" class="btn btn-primary btn-xs reservation_data_confirm_reservation keep_pos">Potwierdź rezerwację</a></td>
                                                    @endif
                                                    <td><a class="reservation_data_delete_reservation keep_pos" href="#"><i class="fas fa-trash-alt"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection
