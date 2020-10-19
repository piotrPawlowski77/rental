@extends('layouts.frontend')

@section('content')

    <main>

        <section class="search_interactive">

            <div class="container">

                <a href="#" class="scrollup"></a>

                <header>
                    <h1>Kontakt</h1>
                    <p>Zapraszamy do kontaktu z naszą firmą</p>
                    <p>Niezwłocznie skontaktujemy się z Państwem poprzez podany adres e-mail</p>
                </header>

                <div class="row">

                    <div class="col-10 offset-1 col-md-10 offset-md-1 col-lg-10 offset-lg-1">

                        <div class="contactForm">

                            <form action="{{ route('sendContactMessage') }}" method="post" id="form1">

                                {{ csrf_field() }}

                                <fieldset>

                                    <legend> Wprowadź dane </legend>

                                    <div class="row_formularza">
                                        <label>Podaj adres e-mail: <input type="email" name="email" id="email" required> </label>
                                    </div>

                                    <div class="row_formularza">
                                        <span id="email_error" class="czerwone"></span>
                                    </div>

                                    <div class="row_formularza">

                                        <div><label for="message_content" >Treść wiadomości</label></div>
                                        <textarea name="message_content" id="message_content" rows="4" cols="30" maxlength="300" minlength="10" style="resize: none" > </textarea>
                                    </div>

                                    <div class="row_formularza">
                                        <span id="message_content_error" class="czerwone"></span>
                                    </div>

                                </fieldset>

                                <div class="row_formularza">
                                    <input type="submit" class="btn btn-success" id="wyslij" value="Wyślij">
                                    <input type="reset" class="btn btn-danger" id="reset" value="Wyczyść dane formularza">
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                            </form>

                        </div>

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

