<?php

namespace App\Policies;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function checkUserPhoto(User $user, Photo $photo)
    {

        //jesli fotografia dotyczy uzytkownika
        if($photo->photoable_type == 'App\Models\User')
        {
            return $user->id === $photo->photoable_id;
        }
        elseif ($photo->photoable_type == 'App\Models\Car')
        {
            //jesli fotografia dotyczy auta - zwracam true
            //bo tylko admin jest uprawniony do dodawania/usuwania zdjec danego auta
            return true;
        }


    }

}
