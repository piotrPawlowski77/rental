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
                    <h1>Twój profil</h1>
                </header>

                <div class="row">

                    <div class="col-sm-12">

                        <form method="POST" action="{{ route('profile') }}" class="form_profile" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label for="name" class="col-lg-2 control-label">Imię *</label>
                                    <div class="col-lg-10">
                                        <input name="name" type="text"  class="form-control" id="name" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="surname" class="col-lg-2 control-label">Nazwisko *</label>
                                    <div class="col-lg-10">
                                        <input name="surname" type="text"  class="form-control" id="surname" value="{{ $user->surname }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-lg-2 control-label">Adres E-mail *</label>
                                    <div class="col-lg-10">
                                        <input name="email" type="email"  class="form-control" id="inputEmail" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPhone" class="col-lg-2 control-label">Telefon *</label>
                                    <div class="col-lg-10">
                                        <input name="phone" type="text"  class="form-control" id="inputPhone" value="{{ $user->phone }}">
                                    </div>
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


                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="submit" class="btn btn-primary">Zapisz</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <label for="userPicture">Dodaj swoje zdjęcie</label>
                                        <input name="userPicture" type="file" id="userPicture">
                                    </div>
                                </div>

                                {{--spr czy obrazek istnieje--}}
                                @if($user->photos()->first())
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6">
                                                <div class="img-thumbnail">
                                                    <img class="img-fluid" src="{{ $user->photos()->first()->path }}" alt="...">
                                                    <div class="figure-caption">
                                                        <p><a href="{{ route('deletePhoto', ['id'=>$user->photos()->first()->id]) }}" class="btn btn-primary btn-xs" role="button">Usuń zdjęcie</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                            </fieldset>

                            {{ csrf_field() }}
                        </form>

                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection
