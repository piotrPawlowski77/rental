<?php

namespace App\Listeners;

use App\Events\ReservationPlacedByClientEvent;
use App\Models\Notification;
use App\Models\Role;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReservationPlacedByClientListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  ReservationPlacedByClientEvent  $event
     * @return void
     */
    public function handle(ReservationPlacedByClientEvent $event)
    {
        Notification::create([

            'user_id' => $id = Role::where('role_name', '=', 'admin')->first()->user_id,
            'content' => __('Zarezerwowano samochód :car w mieście :city od :dayIn do :dayOut ', [

                'car' => $event->res->car->model,
                'city' => $event->res->city->name,
                'dayIn' => $event->res->rental_day_in,
                'dayOut' => $event->res->rental_day_out,

            ]),
            'status' => 0
        ]);
    }
}
