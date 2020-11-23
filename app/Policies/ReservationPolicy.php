<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
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

    public function checkUserReservation(User $user, Reservation $reservation)
    {
        if($user->hasRole(['admin']))
        {
            return true;
        }
        else
        {
            return $user->id === $reservation->user_id;
        }
    }

}
