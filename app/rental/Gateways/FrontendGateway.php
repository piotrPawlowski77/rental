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

        //$emailFromDB = $this->fR->getEmailFromContactTable($request);

        //sprawdzenie czy podany adres email istnieje już w bazie
        if( $this->fR->getEmailFromContactTable($request) != null )
        {
            return redirect()->back()->withErrors(['Podany adres email już istnieje w bazie!']);
        }
        else
        {
            $regex_rules = array(
                'email' => array('required', 'regex:/^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,3}$/'),
                'message_content' => array('required', 'min:10', 'max:255')
            );

            $this->validate($request, $regex_rules);

            //jesli validate() nie przejdzie to kod ponizej nie zostanie wykonany.
            //Przekieruje nas na strone gdzie bylismy

            //walidacja ok
            return $this->fR->saveContactMessage($request);
        }

    }

}
