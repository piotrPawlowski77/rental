<?php


namespace App\rental\Repositories;

//komunikacja z BD

use App\Models\Car;
use App\Models\City;
use App\Models\Reservation;
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

    //metoda z traitu AjaxRequests - zwraca dane 1 rezerwacji
    public function getReservationData($request)
    {
        //id samochodu odpowiada id z requestu ktory znajdzie sie
        //w {} (admin_scripts)

        //znajdz taka rezerwacje gdzie id auta jest = id auta z requestu
        //i kliknieta data w kalendarzu zawiera sie w przedziale tej rezerwacji
        //tylko 1 przypadek mozliwy



        return Reservation::with('user', 'car')
            ->where('car_id', $request->input('car_id'))
            ->where('rental_day_in', '<=', $request->input('date'))
            ->where('rental_day_out', '>=', $request->input('date'))
            ->first();
    }

    public function getReservation($id)
    {
        return Reservation::find($id);
    }

    public function confirmReservation(Reservation $reservation)
    {
        //dd('udalo sie potwierdzic');
        return $reservation->update(['status'=>true]);
    }

    public function deleteReservation(Reservation $reservation)
    {
        //dd('udalo sie usunac');
        //nie potrzebuje juz znac id rezerwacji bo juz zostala znaleziona w met. getReservation($id)
        return $reservation->delete();
    }

    //zwraca wszystkie miasta (CityController)
    public function getAllCities()
    {
        return City::orderBy('name', 'asc')->get();
    }

    public function createNewCity($request)
    {
        $city = new City();

        $city->name = $request->input('name');

        $city->save();

        return redirect()->back()->with('message', 'Dodano nowe miasto.');
    }

    public function getCity($id)
    {
        return City::find($id);
    }

    public function updateCity($request, $id)
    {
        return City::where('id', $id)->update(['name'=>$request->input('name')]);
    }

    public function deleteCity($id)
    {
        return City::where('id', $id)->delete();
    }
}
