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

}
