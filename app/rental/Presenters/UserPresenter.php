<?php


namespace App\rental\Presenters;

//trait - musze go do User.php zaimportowac
//trait = zbior funkcji ktore przydadza nam sie w klasie
trait UserPresenter
{
    //get - slowo klucz. Attribute - slowo klucz = potrzebne by laravel rozpoznal o co chodzi
    //FullName zdef w opinion.blade
    public function getFullNameAttribute()
    {
        return $this->name. ' '.$this->surname;
    }
}
