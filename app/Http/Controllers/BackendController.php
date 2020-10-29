<?php

namespace App\Http\Controllers;

use App\rental\Gateways\BackendGateway;
use App\rental\Interfaces\BackendRepositoryInterface;
use Illuminate\Http\Request;

class BackendController extends Controller
{

    /**
     * BackendController constructor.
     */
    public function __construct(BackendRepositoryInterface $bR, BackendGateway $bG)
    {


        //mamy widoczne repozytorium i gateway w all metodach tej klasy
        $this->bR = $bR;
        $this->bG = $bG;
    }

    public function index()
    {
        return view('backend.index');
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

}
