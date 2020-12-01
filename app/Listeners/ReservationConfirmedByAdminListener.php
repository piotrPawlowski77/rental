<?php

namespace App\Listeners;

use App\Events\ReservationConfirmedByAdminEvent;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReservationConfirmedByAdminListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReservationConfirmedByAdminEvent  $event
     * @return void
     */
    public function handle(ReservationConfirmedByAdminEvent $event)
    {

        Notification::create([

            'user_id' => $id = $event->res->user_id,
            'content' => __('Potwierdzono rezerwację auta :car w mieście :city od :dayIn do :dayOut', [

                'car' => $event->res->car->model,
                'city' => $event->res->city->name,
                'dayIn' => $event->res->rental_day_in,
                'dayOut' => $event->res->rental_day_out,

            ]),
            'status' => 0
        ]);

    }
}
