<?php

namespace App\Http\Controllers;

use App\Events\ReservationPlacedByClientEvent;
use App\Models\Role;
use App\rental\Gateways\FrontendGateway;
use App\rental\Interfaces\FrontendRepositoryInterface;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    /**
     * FrontendController constructor.
     */
    public function __construct(FrontendRepositoryInterface $fR, FrontendGateway $fG)
    {
        //w only(tablica z nazwami metod ktore chce zabezpieczyc przed logowaniem - czynie to zamiast robic rout-y w web.php - jest to inna metoda)
        $this->middleware('auth')->only(['addOpinion', 'addReservation']);

        //mamy widoczne repozytorium i gateway we wszystkich metodach tej klasy
        //robie tak bo prawie kazda metoda tutaj bedzie korzystac z tych wzorcow
        $this->fR = $fR;
        $this->fG = $fG;
    }

    public function index()
    {
        return view('frontend.index');
    }

    public function contact()
    {
        return view('frontend.contact');
    }


    public function sendContactMessage(Request $request)
    {
        //dd($request);

        //najpierw zwaliduj formularz - a potem z gatewaya polacz sie z repozytorium
        $this->fG->sendContactMessage($request);

        return redirect()->back();
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function searchCities(Request $request)
    {
        //lista wszystkich miast
        $result = $this->fG->searchCities($request);

        return response()->json($result);
    }

    public function searchCars(Request $request)
    {

        if($city = $this->fG->getSearchResults($request))
        {
            //dd($city);

            return view('frontend.car_search', compact('city'));
        }
        else
        {
            return redirect('/')->with('message', 'Nie znaleziono ofert dla podanych kryteriów.');
        }


    }

    public function getCarReservationByAjax($car_id)
    {
        //wyciaga rezerwacje dla konkretnego auta
        $carReservations = $this->fR->getCarReservationsById($car_id);


        return response()->json(['carReservations' => $carReservations]);

    }

    public function carReservation($car_id)
    {
        //wyciagnij konkretny samochod z konkretnego miasta
        $car = $this->fR->getCar($car_id);

        //dd($car);

        return view('frontend.car_reservation', compact('car'));
    }

    public function opinions()
    {
        //wyciagnij wszystkie opinie od uzytkownikow
        $opinions = $this->fR->getOpinions();

        //dd($opinions);

        return view('frontend.opinion', compact('opinions'));
    }

    public function addOpinion(Request $request)
    {
        //najpierw zwaliduj formularz - a potem z gatewaya polacz sie z repozytorium
        $this->fG->addOpinion($request);

        return redirect()->back();
    }

    public function addReservation($car_id, $city_id, Request $request)
    {
        //czy moge dokonac rezerwacji: true/false
        $isReservationAvaiable = $this->fG->checkAvaiableReservations($car_id, $request);

        //dd($isReservationAvaiable);

        if($isReservationAvaiable)
        {
            //add reservation - formularz juz zwalidowany we FG
            //wiec moge dokonac rezerwacji
            $reservation = $this->fR->makeReservation($car_id, $city_id,$request);

            event( new ReservationPlacedByClientEvent($reservation) );

            //rezerwacja ok - redirect to admin panel
            return redirect()->route('adminHome');
        }
        else
        {
            //redirect
            //zmienna z komunikatem w sesji dostepna tylko na nastepny request.
            $request->session()->flash('resMessage', 'Brak wolnych terminów.');
            return redirect()->route('carReservation', ['id'=>$car_id]);
        }
    }

}
