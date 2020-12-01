<?php


namespace App\rental\ViewComposers;


use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BackendComposer
{
    //nazwa met. specyficzna - nie moge nazwac jej inaczej (arg to obiekt widoku o ktorego przekaze dane)
    public function compose(View $view)
    {
        //notifications - zmienna dostepna w widokach
        //2-gi arg to wyciagniecie powiadomien z BD (obiekt z powiado z BD)
        //zeby to dzialalo to musi istniec relacja na modelu User
        $view->with('notifications', Notification::where('user_id', Auth::user()->id)->where('status',0)->get());
    }
}
