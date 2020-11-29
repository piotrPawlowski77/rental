@extends('layouts.backend')

@section('content')

    <main>

        <section class="search_interactive">

            <div class="container">

                <a href="#" class="scrollup"></a>

                @if($car ?? false)
                    <header>
                        <h1>Edytuj samochód {{ $car->brand }} {{ $car->model }}</h1>
                    </header>
                @else
                    <header>
                        <h1>Dodaj samochód</h1>
                    </header>
                @endif

                <div class="row">

                    <div class="col-sm-12">

                        <form method="POST" action="{{ route('carPanel', ['id'=>$car->id ?? null]) }}" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label for="city" class="col-lg-2">Miasto *</label>
                                    <div class="col-sm-6 offset-sm-3">
                                        <select name="city" class="form-control" id="city">
                                            @foreach($cities as $city)

                                                @if( ($car ?? false) && ($car->city->id == $city->id) )
                                                    <option selected value="{{ $city->id }}">{{ $city->name }}</option>
                                                @else
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="brand" class="col-lg-2">Marka *</label>
                                    <div class="col-sm-6 offset-sm-3">
                                        <input name="brand" value="{{ $car->brand ?? old('brand') }}"  type="text" class="form-control" id="brand" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="model" class="col-lg-2 control-label">Model *</label>
                                    <div class="col-sm-6 offset-sm-3">
                                        <input name="model" value="{{ $car->model ?? old('model') }}"  type="text" class="form-control" id="model" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="type" class="col-lg-2 control-label">Typ nadwozia *</label>
                                    <div class="col-sm-6 offset-sm-3">
                                        <input name="type" value="{{ $car->type ?? old('type') }}"  type="text" class="form-control" id="type" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="engine" class="col-lg-2 control-label">Silnik *</label>
                                    <div class="col-sm-6 offset-sm-3">
                                        <input name="engine" value="{{ $car->engine ?? old('engine') }}"  type="text" class="form-control" id="engine" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="fuel_type" class="col-lg-2 control-label">Rodzaj paliwa *</label>
                                    <div class="col-sm-6 offset-sm-3">
                                        <input name="fuel_type" value="{{ $car->fuel_type ?? old('fuel_type') }}"  type="text" class="form-control" id="fuel_type" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="color" class="col-lg-2 control-label">Kolor *</label>
                                    <div class="col-sm-6 offset-sm-3">
                                        <input name="color" value="{{ $car->color ?? old('color') }}"  type="text" class="form-control" id="color" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="power" class="col-lg-2 control-label">Moc *</label>
                                    <div class="col-sm-6 offset-sm-3">
                                        <input name="power" value="{{ $car->power ?? old('power') }}"  type="number" class="form-control" id="power" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price" class="col-lg-2 control-label">Cena *</label>
                                    <div class="col-sm-6 offset-sm-3">
                                        <input name="price" value="{{ $car->price ?? old('price') }}"  type="number" class="form-control" id="price" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-6 offset-sm-3">
                                        <label for="carsPicture">Zdjęcia auta</label>
                                        <input type="file" name="carsPicture[]" id="carsPicture" multiple>
                                        <p class="form-text">Dodaj zdjęcia do auta</p>
                                    </div>
                                </div>

                                {{--Przy tworzeniu auta nie bd potrzebowal listy obrazkow --}}
                                @if( $car ?? false)
                                    <div class="col-lg-10 col-lg-offset-2">

                                        @foreach($car->photos->chunk(4) as $chPhotos)

                                            <div class="row">

                                                @foreach($chPhotos as $photo)

                                                    <div class="col-sm-6">
                                                        <div class="img-thumbnail">
                                                            <img class="img-fluid" src="{{ $photo->path ?? $imgTmp }}" alt="...">
                                                            <div class="figure-caption">
                                                                <p><a href="{{ route('deletePhoto', ['id'=>$photo->id]) }}" class="btn btn-primary btn-xs" role="button">Usuń zdjęcie</a></p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                @endforeach

                                            </div>


                                        @endforeach

                                    </div>

                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger col-sm-6 offset-sm-3">
                                        <ul class="ul_errors">
                                            @foreach ($errors->all() as $error)
                                                <li class="czerwone">{{ $error }} </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <div class="col-sm-6 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Zapisz</button>
                                    </div>
                                </div>

                            </fieldset>
                            {{ csrf_field() }}
                        </form>

                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection
