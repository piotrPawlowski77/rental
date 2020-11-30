<?php

namespace App\Http\Controllers;

use App\rental\Gateways\BackendGateway;
use App\rental\Interfaces\BackendRepositoryInterface;
use App\rental\Traits\AjaxRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BackendController extends Controller
{

    use AjaxRequests; //oddzielenie kodu z requestami ajax

    /**
     * BackendController constructor.
     */
    public function __construct(BackendRepositoryInterface $bR, BackendGateway $bG)
    {
        $this->middleware('CheckAdmin')->only(['myCars', 'carPanel', 'confirmReservation']);

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

    public function profile(Request $request)
    {

        if($request->isMethod('post'))
        {
            //zapis danych - walidacja
            $user = $this->bG->saveEditUser($request);

            if($request->hasFile('userPicture'))
            {
                $photoPath = $request->file('userPicture')->store('usersPhotos', 'public');
                //dd($photoPath);

                //spr czy uzytkownik ktory uploaduje obrazek mial wczesniej jakis obrazek
                if(count($user->photos)!=0)
                {
                    //wyciagnij zdj usera ktore ma po id
                    $photo = $this->bR->getUserPhotoFromDB($user->photos->first()->id);

                    //usun foto z (storage/app/public)
                    //za pomoca sciezki z BD usune z tego folderu photo
                    Storage::disk('public')->delete($photo->storagepath);

                    //przypisz nowa sicezke do nowego foto
                    $photo->path = $photoPath;

                    //update foto
                    $this->bR->updateUserPhoto($user, $photo);
                }
                else
                {
                    //stworzenie nowego foto
                    //czyli zapis sciezki do bazy danych
                    $this->bR->createUserPhoto($user, $photoPath);
                }

            }

            return redirect()->back()->with('message', 'Zaktualizowano dane profilu.');
        }

        return view('backend.profile', ['user'=>Auth::user()]);
    }

    //usuwanie zdjec
    public function deletePhoto($id)
    {
        $photo = $this->bR->getUserPhotoFromDB($id);

        $this->authorize('checkUserPhoto', $photo);

        //autoryzacja/walidacja zdjecia przebiegla ok - moge usunac obrazek
        //usun sciezke z BD
        $photoPath = $this->bR->deletePhoto($photo);

        //usun z dysku serwera
        Storage::disk('public')->delete($photoPath);

        return redirect()->back()->with('message', 'Usunięto zdjęcie profilu.');

    }

    public function myCars()
    {
        //lista aut w danym miescie
        $cities = $this->bR->getCarsFromCity();

        //dd($cities);

        return view('backend.my_cars', compact('cities'));
    }

    public function carPanel($id = null, Request $request)
    {

        //post - zapisz nowego auta / edycja nowego auta
        if($request->isMethod('POST'))
        {
            $this->bG->saveCar($id, $request);

            if($id)
                return redirect()->back()->with('message', 'Samochód został edytowany.'); //przekierowuje sie spowrotem jesli bd edytowal auto (abym mogl zobaczyc zmiany)
            else
                return redirect()->route('myCars');  //jesli bd tworzyl nowe auto to przekieruje sie do LISTY AUT (Lista samochodow)

        }

        //KIEDY REQUEST JEST GET: tworzenie/edycja
        //jesli $id nie jest null
        if($id)
        {
            //edytuje istniejace auto
            return view('backend.car_panel', ['car'=>$this->bR->getCar($id), 'cities'=>$this->bR->getAllCities()]);
        }
        else
        {
            //zwracam widok z lista miast
            return view('backend.car_panel', ['cities'=>$this->bR->getAllCities()]);
        }

    }

    public function confirmReservation($id)
    {
        $reservation = $this->bR->getReservation($id);

        //jesli authorize nie przejdzie to kod ponizej NIE ZOSTANIE WYKONANY
        //rezerwacja nie zostanie potwierdzona.
        $this->authorize('checkUserReservation', $reservation);

        //potwierdzenie rezerwacji wyciagnietej z BD
        $this->bR->confirmReservation($reservation);

        return redirect()->back()->with('message', 'Rezerwacja została potwierdzona.');
    }

    public function deleteReservation($id)
    {

        $reservation = $this->bR->getReservation($id);

        //jesli authorize nie przejdzie to kod ponizej NIE ZOSTANIE WYKONANY
        //rezerwacja nie zostanie usunieta.
        $this->authorize('checkUserReservation', $reservation);

        //usuniecie rezerwacji wyciagnietej z BD
        $this->bR->deleteReservation($reservation);

        return redirect()->back()->with('message', 'Rezerwacja została usunięta.');
    }
    public function deleteCar($id)
    {
        $this->bR->deleteCar($id);

        return redirect()->back()->with('message', 'Samochód został usunięty.');
    }

}
