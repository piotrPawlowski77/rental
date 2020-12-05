<?php


namespace App\rental\Gateways;

//w gateway uzywac bd repozytorium
//GATEWAY = walidacja form, logika biznesowa, odwolanie do repozytorium

use App\Models\Photo;
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
                'userPicture' => array('image', 'max:200'),
            );

            $error_messages = array(
                'userPicture.image' => 'Plik musi być zdjęciem',
                'userPicture.max' => 'Zdjęcie nie może być większe niż 200kb',

            );

            $this->validate($request, $rules, $error_messages);

        }

        //walidacja przeszla = zapisz usera w bd
        return $this->bR->saveEditUser($request);

    }

    //id auta, dane formularza
    public function saveCar($id, $request)
    {
        //walidacja
        $rules = array(

            'city' => array('required', 'string'),
            'brand' => array('required', 'string'),
            'model' => array('required', 'string'),
            'type' => array('required', 'string'),
            'engine' => array('required', 'string'),
            'fuel_type' => array('required', 'string'),
            'color' => array('required', 'string'),
            'power' => array('required', 'integer'),
            'price' => array('required', 'integer'),
        );

        $error_messages = array(
            'city.required' => 'Miasto jest wymagane',
            'city.string' => 'Miasto musi być ciągiem znaków',

            'brand.required' => 'Marka jest wymagane',
            'brand.string' => 'Marka musi być ciągiem znaków',

            'model.required' => 'Model jest wymagane',
            'model.string' => 'Model musi być ciągiem znaków',

            'type.required' => 'Typ nadwozia jest wymagane',
            'type.string' => 'Typ nadwozia musi być ciągiem znaków',

            'engine.required' => 'Silnik jest wymagane',
            'engine.string' => 'Silnik musi być ciągiem znaków',

            'fuel_type.required' => 'Rodzaj paliwa jest wymagane',
            'fuel_type.string' => 'Rodzaj paliwa musi być ciągiem znaków',

            'color.required' => 'Kolor auta jest wymagane',
            'color.string' => 'Kolor auta musi być ciągiem znaków',

            'power.required' => 'Moc silnika jest wymagane',
            'power.integer' => 'Moc silnika musi być liczbą',

            'price.required' => 'Cena jest wymagane',
            'price.integer' => 'Cena musi być liczbą',

        );

        $this->validate($request, $rules, $error_messages);


        //czy byl upload zdjec
        if($request->hasFile('carsPicture'))
        {
            //to do
            //potrzebny mi dostep do obiektu auta wiec
            //metody: updateCar i createCar przypisze do zmiennych $car

            //walidacja
            $this->validate($request, Photo::imgRules($request, 'carsPicture'));


            if($id)
            {
                $car = $this->bR->updateCar($id, $request);
                //update car
            }
            else
            {
                $car = $this->bR->createCar($request);
                //create new car- nie przekazuje $id bo nie istnieje jeszcze samochod
            }

            //jesli walidacja przejdzie to = wszystkie obrazki musze uplodowac do store i BD
            foreach ($request->file('carsPicture') as $picture)
            {
                $photoPath = $picture->store('carsPicture', 'public');

                //nie wystarczy mi sam upload. Musze zapisac jeszcze sciezke w BD
                $this->bR->saveCarPhotos($car, $photoPath);
            }

        }

        //return $car;
    }


}
