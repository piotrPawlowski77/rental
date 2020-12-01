<?php

namespace App\rental\Traits;


use Illuminate\Http\Request;

trait AjaxRequests
{

    public function getReservationDataFromDbByAjax(Request $request)
    {
        //pobieram dane 1 rezerwacji
        $reservation = $this->bR->getReservationData($request);

        //to sa dane ajax czyli musze zwrocic dane typu json


        return response()->json([

            'car_id' => $reservation->car_id,
            'car_name' => $reservation->car->brand . ' ' . $reservation->car->model,
            'rental_day_in' => $reservation->rental_day_in,
            'rental_day_out' => $reservation->rental_day_out,
            'FullName' => $reservation->user->FullName,
            'confirmResLink' => route('confirmReservation', ['id' => $reservation->id]),
            'deleteResLink' => route('deleteReservation', ['id' => $reservation->id]),
            'status' => $reservation->status,

        ]);

    }

    public function setReadNotificationByAjax(Request $request)
    {
        //zapis w BD
        return $this->bR->setReadNotificationByAjax($request);
    }

}
