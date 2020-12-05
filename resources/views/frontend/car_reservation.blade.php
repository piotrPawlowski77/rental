@extends('layouts.frontend')

@section('content')

    <main>

        <section class="search_interactive">

            <div class="container">

                <a href="#" class="scrollup"></a>

                <header>
                    <h1>Samochód: {{ $car->brand }} {{ $car->model  }} w mieście {{ $car->city->name }}</h1>
                    <p>Zdjęcia</p>
                </header>

                @foreach( $car->photos->chunk(4) as $chunked_car_photos )

                    <div class="row">

                        @foreach($chunked_car_photos as $car_photo)

                            <div class="col-md-3 col-sm-6">

                                <div class="img-thumbnail">

                                    <img class="img-fluid" src="{{ $car_photo->path ?? $imgTmp2 }}" alt="#">

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endforeach

                <header>
                    <h1>Dane techniczne</h1>
                </header>

                    <div class="row">

                        <div class="col-sm-12 col-md-12 col-lg-12">

                            <div class = "table-responsive">
                                <table class = "table">

                                    <thead>
                                    <tr>
                                        <th>{{ $car->brand }}</th>
                                        <th>{{ $car->model  }}</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td>Typ</td>
                                        <td>{{ $car->type }}</td>
                                    </tr>
                                    <tr>
                                        <td>Silnik</td>
                                        <td>{{ $car->engine }}</td>
                                    </tr>
                                    <tr>
                                        <td>Rodzaj paliwa</td>
                                        <td>{{ $car->fuel_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kolor</td>
                                        <td>{{ $car->color }}</td>
                                    </tr>
                                    <tr>
                                        <td>Moc</td>
                                        <td>{{ $car->power }} km</td>
                                    </tr>
                                    <tr>
                                        <td>Cena za dzień</td>
                                        <td>{{ $car->price }} zł</td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>

                        </div>

                    </div>

                <header>
                    <h1>Rezerwacja</h1>
                    <p>Kalendarz dostępności</p>
                </header>

                    <div class="row">

                        <div class="col-sm-12">
                            <div id="car_avaiability_calendar"></div>
                        </div>

                        <div class="col-sm-12">

                            <form method="post" action="{{ route('addReservation', ['car_id'=>$car->id, 'city_id'=>$car->city_id]) }}" class="form_interactive form_reservation">

                                <div class="form-group">
                                    <label class="sr-only" for="check_in">Data odbioru</label>
                                    <input name="check_in" type="text" class="form-control" id="check_in" placeholder="Data odbioru" >
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="check_out">Data zwrotu</label>
                                    <input name="check_out" type="text" class="form-control" id="check_out" placeholder="Data zwrotu" >
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="ul_errors">
                                            @foreach ($errors->all() as $error)
                                                <li class="czerwone">{{ $error }} </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-success">Zarezerwuj</button>

                                <p class="text-danger">{{ \Illuminate\Support\Facades\Session::get('resMessage') }}</p>

                                {{ csrf_field() }}

                            </form>

                        </div>

                    </div>

            </div> <!-- end container -->

        </section>

    </main>

@endsection

@push('car_avaiable_dates_script')

    <script type="text/javascript">

        function DatesRangeFromTo(rentalDayIn, rentalDayOut)
        {
            //deklaracja tablicy pomocniczej
            var tmpTab = [];
            //datepicker wymaga dat w postaci obiektu wiec
            var dayIn = new Date(rentalDayIn);
            var dayOut = new Date(rentalDayOut);

            //doklejanie dat do tablicy tmpTab
            //trzeba uzyc metod datepicker-a
            while(dayIn <= dayOut)
            {
                tmpTab.push( $.datepicker.formatDate('yy-mm-dd', new Date(dayIn)) );
                //zwiekszenie daty poczatkowej o 1 (na obiekce Date wykonuje metode setDate)
                dayIn.setDate(dayIn.getDate()+1);
            }

            //mam tablice z datami
            return tmpTab;
        }

        //wyciagam ajax-em rezerwacje tego konkretnego auta
        $.ajax({
            cache: false, //pewnosc ze dane sa zawsze aktualne (nie brane z pamieci cache)
            url: b_url +  '/getCarReservationByAjax/' + {{ $car->id }}, //ajaxGetRoomReservations = nazwa metody ktora zwroci rezerwacje pokoju
            type: "GET", //get nie post bo tu nie operuje na formularzu
            success: function (response) {
                //response = dane JSON zwrocone z serwera = wszystkie rezerwacje dla konkretnego auta

                var datesToDatepicker = {};
                var datesFromDB = [];
                for(var i=0; i<= response.carReservations.length -1; i++)
                {
                    //wszystkie rezerwacje dla konkretnego auta
                    datesFromDB.push( DatesRangeFromTo( new Date( response.carReservations[i].rental_day_in ), new Date( response.carReservations[i].rental_day_out )) );

                }

                //datesFromDB zawiera teraz tablice tablic. Niewygodne to wiec musze ja "splaszczyc"
                //1. wyzeruj tablece datesFromDB. 2. wykonaj na tym metode concat.apply()
                datesFromDB = [].concat.apply([], datesFromDB);

                //w petli operuje juz na tablicy 1 wymiarowej
                for(var i=0; i<= datesFromDB.length -1; i++)
                {
                    //daty do klanedarza - obiekt dla datepickera
                    datesToDatepicker[datesFromDB[i]] = datesFromDB[i];

                }

                $(function () {
                    $("#car_avaiability_calendar").datepicker({

                        //onSelect => jak klikne w dzien na kalendarzu to pola w form mi sie uzupelnia
                        onSelect: function (dateText) {

                            //console.log($('#check_in').val());

                            if($('#check_in').val() == '')
                            {
                                $('#check_in').val(dateText);
                            }
                            else if($('#check_out').val() == '')
                            {
                                $('#check_out').val(dateText);
                            }
                            else if($('#check_out').val() != '')
                            {
                                $('#check_in').val(dateText);
                                $('#check_out').val('');
                            }

                        },
                        //zanim wyswietle dni w kalendarzu, to przed kazdym dniem zostanie spr
                        //czy w tablicy z datami dostepnosci mam niedostepne daty
                        //jesli jest to zwracam tablice [false -> nie jest klikalne to pole, klasa_css]
                        //else pole klikalne
                        beforeShowDay: function (date) {

                            //console.log(date);
                            var tab = datesToDatepicker[ $.datepicker.formatDate('yy-mm-dd', date) ];
                            if(tab)
                                return [false, 'niedostepny_dzien'];
                            else
                                return [true, ''];

                        }


                    });
                });

            }

        });

    </script>

@endpush
