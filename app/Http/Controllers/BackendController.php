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
        return 'to do';
    }

    public function deleteReservation($id)
    {
        return 'to do';
    }

}
