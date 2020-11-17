<?php


namespace App\rental\Repositories;

//komunikacja z BD

use App\Models\Car;
use App\rental\Interfaces\BackendRepositoryInterface;

class BackendRepository implements BackendRepositoryInterface
{
    public function getAdminReservations($request)
    {
        //zwracam samochody z rezerwacjami
        //samochod posiada rezerwacje
        //a rezerwacja nalezy do jakiegos usera
        return Car::with([

            'reservations.user'

        ])
            ->has('reservations')
            ->get();
    }

    public function getClientReservations($request)
    {
        //zwracam samochody z rezerwacjami
        //samochod posiada rezerwacje
        //a rezerwacja nalezy do jakiegos usera

        //whereHas - dziala podobinie do hsa ALE umozliwia postawienie konkretnego warunku
        //(2-gi parametr to f. anonimowa - filtrujaca dane dla okreslonego warunku)
        //use ($request) = potrzebne by zmienna $request byla widoczna w f. anonimowej
        //zwroc mi te auta ktore posiadaja jakies rezerwacje
        //ale musze wiedziec jakie sa te rezerwacje
        //czyli rezerwacje aktualnie zalogowanego uzytkownika
        // (w tabeli reservations mam id klienta ktory zarezerwowal dane auto)
        //tu user_id odnosi sie do tabeli reservations.

        //suma
        //zwroc mi te auta ktore posiadaja co najmniej 1 rezerwacje taka
        //ktora ma w tabeli user_id - id aktualnie zalog. usera

        return Car::with([

            'reservations.user',

            'reservations' => function($q1) use($request){

                $q1->where('user_id', $request->user()->id);

            }

        ])
            ->whereHas('reservations', function ($query) use ($request){

                $query->where('user_id', $request->user()->id);

            })
            ->get();

    }

}
