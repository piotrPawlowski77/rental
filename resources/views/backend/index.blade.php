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

                                    var datesToDatepicker{{ $c }} = {};
                                    var datesConf{{ $c }} = [];
                                    var datesNotConf{{ $c }} = [];

                                    @foreach($car->reservations as $reservation)

                                        @if($reservation->status)
                                            datesConf{{ $c }}.push( DatesRangeFromTo( new Date('{{ $reservation->rental_day_in }}'), new Date('{{ $reservation->rental_day_out }}') ) );
                                        @else
                                            datesNotConf{{ $c }}.push( DatesRangeFromTo( new Date('{{ $reservation->rental_day_in }}'), new Date('{{ $reservation->rental_day_out }}') ) );
                                        @endif

                                    @endforeach

                                    datesConf{{ $c }} = [].concat.apply([], datesConf{{ $c }});
                                    datesNotConf{{ $c }} = [].concat.apply([], datesNotConf{{ $c }});

                                    for (var i = 0; i < datesConf{{ $c }}.length; i++)
                                    {
                                        datesToDatepicker{{ $c }}[ datesConf{{ $c }}[i] ] = 'potwierdzona';
                                    }

                                    var tmp{{ $c }} = {};
                                    for (var i = 0; i < datesNotConf{{ $c }}.length; i++)
                                    {
                                        tmp{{ $c }}[ datesNotConf{{ $c }}[i] ] = 'niepotwierdzona';
                                    }


                                    Object.assign(datesToDatepicker{{ $c }}, tmp{{ $c }});


                                    $(function () {
                                        $(".reservationCalendar" + {{ $c }}).datepicker({
                                            onSelect: function (date) {

                                                //to do.. pobrac dane rezerwacji z serwera Ajaxem

                                                $('.reservationData' + {{ $c }}).hide();

                                                Application.GetReservationDataFromDB({{ $car->id }}, {{ $c }}, date);

                                            },
                                            beforeShowDay: function (date)
                                            {
                                                var tmp = datesToDatepicker{{ $c }}[ $.datepicker.formatDate('yy-mm-dd', date)];
                                                //console.log(tmp);
                                                if (tmp)
                                                {
                                                    if (tmp == 'potwierdzona')
                                                        return [true, 'rezerw_potwierdzona'];
                                                    else
                                                        return [true, 'rezerw_niepotwierdzona'];
                                                } else
                                                    return [false, ''];

                                            }


                                        });
                                    });


                                </script>
                            @endpush

                            <h3>Miasto {{ $car->city->name }}</h3>

                            <h4>Samochód {{ $car->brand }} {{ $car->model }}</h4>

                            <div class="col-md-3">
                                <div class="reservationCalendar{{ $c }}" id="{{ $c }}"></div>
                            </div>

                            <!-- Dane rezerwacji -->
                            <div class="col-md-9">
                                <div class="reservationData{{ $c }}" style="display: none;">

                                    <div class="table-responsive">

                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Id auta</th>
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
                                                    <td class="reservationData_car_id"></td>
                                                    <td class="reservationData_car_name"></td>
                                                    <td class="reservationData_day_in"></td>
                                                    <td class="reservationData_day_out"></td>
                                                    <td class="reservationData_person" ></td>
                                                    @if( \Illuminate\Support\Facades\Auth::user()->hasRole(['admin']) )
                                                        <td><a href="#" class="btn btn-primary reservationData_confirm_reservation keep_pos">Potwierdź rezerwację</a></td>
                                                    @endif
                                                    <td><a class=" btn btn-primary reservatioData_delete_reservation keep_pos" href="#">Usuń rezerwację</a></td>
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
