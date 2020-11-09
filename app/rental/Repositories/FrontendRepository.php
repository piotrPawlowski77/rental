<?php


namespace App\rental\Repositories;

//komunikacja z BD

use App\Models\Car;
use App\Models\City;
use App\Models\Contact;
use App\Models\Reservation;
use App\rental\Interfaces\FrontendRepositoryInterface;

class FrontendRepository implements FrontendRepositoryInterface
{

    public function getEmailFromContactTable($request)
    {
        //$contact = Contact::select('email')->where('email', $request->email)->first();
        return Contact::select('email')->where('email', $request->email)->first();
        //dd($contact->email);
        //return $contact->email;
    }

    public function saveContactMessage($request)
    {
        //Tworze instancje kontaktu
        $contact = new Contact();

        $contact->email = $request->input('email');
        $contact->message_content = $request->input('message_content');

        $contact->save();

        return redirect()->back()->with('message', 'Dane wysłano pomyślnie.');
    }

    //znajduje miasta do autocomplete wyszukiwarki
    public function getSearchCities(string $term)
    {
        return City::where('name', 'LIKE', $term.'%')->get();
    }

    //znajduje wszystkie auta z danego miasta
    public function getAllCarsFromCity(string $city)
    {
        return City::with(['cars.reservations', 'cars.photos'])->where('name',$city)->first() ?? false;
    }

    public function getCar($car_id)
    {
        return Car::with(['city'])->find($car_id);
    }

    //znajduje rezerwacje dla konkretnego auta za pomoca jego id
    public function getCarReservationsById($car_id)
    {
        return Reservation::where('car_id', $car_id)->get();
    }
}
