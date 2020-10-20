<?php

namespace App\rental\Gateways;

//w gateway uzywac bd repozytorium
//GATEWAY = walidacja form, logika biznesowa, odwolanie do repozytorium

use App\rental\Interfaces\FrontendRepositoryInterface;
use Illuminate\Foundation\Validation\ValidatesRequests;

class FrontendGateway
{
    use ValidatesRequests; //import z Controller.php - potrzebny do zastos. tu metody validate()


    /**
     * FrontendGateway constructor.
     */
    public function __construct(FrontendRepositoryInterface $fR)
    {
        $this->fR = $fR;
        //i mam w gateway dostepne moje repo dla kazdej metody
    }

    public function sendContactMessage($request)
    {
        //walidacja
        //validate() to metoda Controller-a i musze zaimportowac trait (na poczatku tej klasy jest)
        //ktory umozliwi mi wykonanie metody validate, poniewaz jestem we frontend Gateway

        $regex_rules = array(
            'email' => array('required', 'regex:/^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,3}$/'),
            'message_content' => array('required', 'regex:/^[a-zA-Z0-9]{10,}$/')
            );

        $this->validate($request, $regex_rules);

        //jesli validate() nie przejdzie to kod ponizej nie zostanie wykonany.
        //Przekieruje nas na strone gdzie bylismy

        //walidacja ok
        return $this->fR->sendContactMessage($request);

    }

}
