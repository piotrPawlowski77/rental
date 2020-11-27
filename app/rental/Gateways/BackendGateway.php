<?php


namespace App\rental\Gateways;

//w gateway uzywac bd repozytorium
//GATEWAY = walidacja form, logika biznesowa, odwolanie do repozytorium

use App\rental\Interfaces\BackendRepositoryInterface;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BackendGateway
{

    use ValidatesRequests; //import z Controller.php - potrzebny do zastos. tu metody validate()

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

    public function createNewCity($request)
    {
        $rules = array(
            'name' => array('required', 'string', 'unique:cities'),
        );

        $error_messages = array(
            'name.required' => 'Nazwa miasta jest wymagana',
            'name.string' => 'Nazwa miasta musi być ciągiem znaków',
            'name.unique' => 'Nazwa miasta już istnieje w bazie',

        );

        $this->validate($request, $rules, $error_messages);
        //jesli validate() nie przejdzie to kod ponizej nie zostanie wykonany.
        //Przekieruje nas na strone gdzie bylismy

        //zapis miasta do BD -> bR
        $this->bR->createNewCity($request);
    }

    public function updateCity($request, $id)
    {
        $rules = array(
            'name' => array('required', 'string', 'unique:cities'),
        );

        $error_messages = array(
            'name.required' => 'Nazwa miasta jest wymagana',
            'name.string' => 'Nazwa miasta musi być ciągiem znaków',
            'name.unique' => 'Nazwa miasta już istnieje w bazie',

        );

        $this->validate($request, $rules, $error_messages);


        $this->bR->updateCity($request, $id);
    }

    public function saveEditUser($request)
    {
        //walidacja
        $rules = array(
            'name' => array('required', 'string'),
            'surname' => array('required', 'string'),
            'email' => array('required', 'email'),
            'phone' => array('required'),
        );

        $error_messages = array(
            'name.required' => 'Imię użytkownika jest wymagane',
            'name.string' => 'Imię użytkownika musi być ciągiem znaków',
            'surname.required' => 'Nazwisko użytkownika jest wymagane',
            'surname.string' => 'Nazwisko użytkownika musi być ciągiem znaków',
            'email.required' => 'Email jest wymagany',
            'email.email' => 'Wymagany poprawny adres email @',
            'phone.required' => 'Numer telefonu jest wymagany',

        );

        $this->validate($request, $rules, $error_messages);

        //jesli obraz jest wczytany - walidacja
        if($request->hasFile('userPicture'))
        {
            //walidacja
            $rules = array(
                'userPicture' => array('image', 'max:100'),
            );

            $error_messages = array(
                'userPicture.image' => 'Plik musi być zdjęciem',
                'userPicture.max' => 'Zdjęcie nie może być większe niż 100kb',

            );

            $this->validate($request, $rules, $error_messages);

        }

        //walidacja przeszla = zapisz usera w bd
        return $this->bR->saveEditUser($request);

    }


}
