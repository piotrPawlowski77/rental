@extends('layouts.frontend')

@section('content')

    <main>

        <section class="search_interactive">

            <div class="container">

                <a href="#" class="scrollup"></a>

                @if (\Illuminate\Support\Facades\Session::has('message'))

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ \Illuminate\Support\Facades\Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <header>
                    <h1>Opinie</h1>
                    <p>To piszą o nas nasi użytkownicy</p>
                </header>

                <div class="row">

                    @foreach($opinions as $opinion)
                        <div class="media media_conf" >

                            <img title="{{ $opinion->user->FullName }}" class="align-self-start mr-3" width="64" height="64" src="{{ $opinion->user->photos->first()->path ?? $imgTmp }}" alt="...">

                            <div class="media-body">
                                <h5 class="mt-0">{{ $opinion->user->FullName }} napisał/a: </h5>
                                {{ $opinion->content }}

                                <div class="w-100"></div>

                                @for($i=1; $i<=$opinion->rating; $i++ )
                                    <span class="fa fa-star checked"></span>
                                @endfor
                            </div>
                        </div>

                        <div class="w-100"></div>

                    @endforeach

                    <!-- zalogowani -->
                    @auth()
                        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseOpinion" aria-expanded="false" aria-controls="collapseOpinion">
                           Dodaj opinie
                        </a>
                    @else
                        <div class="alert alert-info alert_style" role="alert">
                            <p class="mb-0">Aby dodać opinie <a href="{{ route('login') }}" class="alert-link">zaloguj się</a> lub <a href="{{ route('register') }}" class="alert-link">załóż konto</a></p>
                        </div>
                    @endauth

                    <div class="collapse col-sm-12" id="collapseOpinion">
                        <div class="card card-body">
                            <form method="POST" action="{{ route('addOpinion') }}">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="content" class="col-lg-2">Opinia</label>
                                        <div class="col-lg-10">
                                            <textarea name="content" value="{{ old('content') }}" class="form-control" rows="3" cols="30" minlength="10" maxlength="255" id="content" style="resize: none"></textarea>
                                            <span>Dodaj opinie o naszym serwisie.</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="select" class="col-lg-2">Ocena</label>
                                        <div class="col-lg-10">
                                            <select name="rating" class="form-control" id="select">
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2">2</option>
                                                <option value="1">1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <button type="submit" class="btn btn-primary">Wyślij</button>
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

                                </fieldset>
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection

