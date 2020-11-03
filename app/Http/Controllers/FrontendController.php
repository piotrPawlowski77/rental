<?php

namespace App\Http\Controllers;

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

    public function carReservation()
    {

    }

}
