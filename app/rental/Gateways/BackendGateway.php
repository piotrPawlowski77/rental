<?php


namespace App\rental\Gateways;

//w gateway uzywac bd repozytorium
//GATEWAY = walidacja form, logika biznesowa, odwolanie do repozytorium

use App\rental\Interfaces\BackendRepositoryInterface;

class BackendGateway
{
    /**
     * BackendGateway constructor.
     */
    public function __construct(BackendRepositoryInterface $bR)
    {
        $this->bR = $bR;
    }

    public function getReservations($request)
    {
        //na poczatek spr czy user zalogowany to: klient lub admin
        if($request->user()->hasRole(['admin']))
        {
            $cars = $this->bR->getAdminReservations($request);
        }
        else
        {
            $cars = $this->bR->getClientReservations($request);
        }

        return $cars;

    }


}
