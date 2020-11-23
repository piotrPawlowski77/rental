<?php

namespace App\Http\Controllers;

use App\rental\Gateways\BackendGateway;
use App\rental\Interfaces\BackendRepositoryInterface;
use App\rental\Traits\AjaxRequests;
use Illuminate\Http\Request;

class BackendController extends Controller
{

    use AjaxRequests; //oddzielenie kodu z requestami ajax

    /**
     * BackendController constructor.
     */
    public function __construct(BackendRepositoryInterface $bR, BackendGateway $bG)
    {
        $this->middleware('CheckAdmin')->only(['myCars', 'addCar', 'cities', 'confirmReservation']);

        //mamy widoczne repozytorium i gateway w all metodach tej klasy
        $this->bR = $bR;
        $this->bG = $bG;

    }

    public function index(Request $request)
    {
        //zmienna zawiera wszystkie samochody z rezerwacjami
        $cars = $this->bG->getReservations($request);

//        dd($cars);

        return view('backend.index', compact('cars'));
    }

    public function profile()
    {
        return view('backend.profile');
    }

    public function myCars()
    {
        return view('backend.my_cars');
    }

    public function addCar()
    {
        return view('backend.add_car');
    }

    public function cities()
    {
        return view('backend.cities');
    }

    public function confirmReservation($id)
    {
        $reservation = $this->bR->getReservation($id);

        //jesli authorize nie przejdzie to kod ponizej NIE ZOSTANIE WYKONANY
        //rezerwacja nie zostanie potwierdzona.
        $this->authorize('checkUserReservation', $reservation);

        //potwierdzenie rezerwacji wyciagnietej z BD
        $this->bR->confirmReservation($reservation);

        return redirect()->back()->with('message', 'Rezerwacja została potwierdzona.');;
    }

    public function deleteReservation($id)
    {

        $reservation = $this->bR->getReservation($id);

        //jesli authorize nie przejdzie to kod ponizej NIE ZOSTANIE WYKONANY
        //rezerwacja nie zostanie usunieta.
        $this->authorize('checkUserReservation', $reservation);

        //usuniecie rezerwacji wyciagnietej z BD
        $this->bR->deleteReservation($reservation);

        return redirect()->back()->with('message', 'Rezerwacja została usunięta.');
    }

}
