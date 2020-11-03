<?php

namespace App\rental\Gateways;

//w gateway uzywac bd repozytorium
//GATEWAY = walidacja form, logika biznesowa, odwolanie do repozytorium

use App\rental\Interfaces\FrontendRepositoryInterface;
use Illuminate\Foundation\Validation\ValidatesRequests;

class FrontendGateway
{
    use ValidatesRequests; //import z Controller.php - potrzebny do zastos. tu metody validate()


    /**
     * FrontendGateway constructor.
     */
    public function __construct(FrontendRepositoryInterface $fR)
    {
        $this->fR = $fR;
        //i mam w gateway dostepne moje repo dla kazdej metody
    }

    public function sendContactMessage($request)
    {
        //walidacja
        //validate() to metoda Controller-a i musze zaimportowac trait (na poczatku tej klasy jest)
        //ktory umozliwi mi wykonanie metody validate, poniewaz jestem we frontend Gateway

        //$emailFromDB = $this->fR->getEmailFromContactTable($request);

        //sprawdzenie czy podany adres email istnieje już w bazie
        if( $this->fR->getEmailFromContactTable($request) != null )
        {
            return redirect()->back()->withErrors(['Podany adres email już istnieje w bazie!']);
        }
        else
        {
            $rules = array(
                'email' => array('required', 'regex:/^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,3}$/'),
                'message_content' => array('required', 'min:10', 'max:255')
            );

            $error_messages = array(
                'email.required' => 'Adres e-mail jest wymagany',
                'email.regex' => 'Podaj poprawny adres e-mail: użytkownik@serwer.domena',
                'message_content.required' => 'Treść wiadomości jest wymagana',
                'message_content.min' => 'Podaj treść wiadomości dłuższą niż 10 znaków',
                'message_content.max' => 'Podaj treść wiadomości nie dłuższą niż 255 znaków'
            );

            $this->validate($request, $rules, $error_messages);

            //jesli validate() nie przejdzie to kod ponizej nie zostanie wykonany.
            //Przekieruje nas na strone gdzie bylismy

            //walidacja ok
            return $this->fR->saveContactMessage($request);
        }

    }

    public function searchCities($request)
    {
        $term = $request->input('term');

        //tablica zawierajaca miasta z rezultatu zapytan
        $tabCities = [];

        //zapytanie do bazy danych ktore wyszuka miasto odpowiadajace tym znakom wpisanym
        $results = $this->fR->getSearchCities($term);

        foreach ($results as $result)
        {
            //zgodnie z dokumentacja autocomplete
            $tabCities[] = ['id'=>$result->id, 'value'=>$result->name];
        }

        return $tabCities;

    }

    public function getSearchResults($request)
    {
        //to co tu laravel zrobi to do sesji zapisze aktualne wartosci ktore wpisze do formularza
        //i te dane beda dostepne na nastepny request a helper w inpucie old odczytuje wlasnie wartosc z sesji
        //zmienna sesji jest ustawiona tylko na 1 raz. (po nacisniesiu strony glownej lub odswiezeniu strony wartosc z pola zniknie)
        $request->flash();

        //tu bd przetwarzac dane w BD tylko wtedy gdy miasto NIE JEST PUSTE, tzn gdy ktos
        //kliknie szukaj bez wpisania nazwy miasta to zapytanie nie wykonam
        if($request->input('city') != null)
        {
            //w tym miejscu uzyskam wszystkie auta z konkretnego miasta - wczytujac modele zalezne
            $allCarsInCity = $this->fR->getAllCarsFromCity($request->input('city'));

            //dd($allCarsInCity);

            //jesli istnieja auta
            if($allCarsInCity)
            {
                //w petli przechodze po wszystkich autach z danego miasta
                foreach ($allCarsInCity->cars as $key=>$car)
                {
                    //filtrowanie wynikow
                    //odwoluje sie w petli do rezerwacji dla danego auta - warunek rezerwacje
                    foreach ($car->reservations as $reservation)
                    {
                        //jesli np. auto w BD jest zarezerwowane od 1-5 pazdziernika a my chcemy wypozyczyc je od 2-3pazdziernika
                        //to nie interesuje mnie ten samochod
                        if($request->input('check_in') >= $reservation->rental_day_in
                        && $request->input('check_in') <= $reservation->rental_day_out)
                        {
                            //wyrzucam ten samochod z kolekcji - instrukcja forget() w laravel
                            $allCarsInCity->cars->forget($key);
                        }
                        //to samo z data zwrotu. jesli auto w BD jest zarezerwowane od 1-5 pazdziernika a my chcemy je oddac
                        //w tym przedziale to nie interesuje mnie ten samochod
                        elseif ($request->input('check_out') >= $reservation->rental_day_in
                        && $request->input('check_out') <= $reservation->rental_day_out)
                        {
                            $allCarsInCity->cars->forget($key);
                        }
                        //jesli data wypozyczenia bedzie <= daty wypozyczenia z BD
                        //oraz data zwrotu bedzie >= daty zwrotu z BD
                        //czyli auto w BD mam zarezerwowane od 3-7 pazdziernik
                        //a ja chce wypozyczyc od 1 do 9 pazdziernika
                        //to nie interesuje mnie ten samochod
                        elseif ($request->input('check_in') <= $reservation->rental_day_in
                        && $request->input('check_out') >= $reservation->rental_day_out)
                        {
                            $allCarsInCity->cars->forget($key);
                        }

                    }
                }

                //wyniki przefiltrowane - sprawdzam czy ilosc aut po filtrowaniu jest > od 0
                //jesli true - zwracam wyszukane samochody
                //w przeciwnym wypadku - false
                if(count($allCarsInCity->cars) > 0)
                {
                    return $allCarsInCity;
                }
                else
                {
                    return false;
                }

            }
        }

        //zwracam false. Nie dotykam BD
        return false;
    }

}
