<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $fillable = ['rental_day_in', 'rental_day_out', 'status', 'user_id', 'city_id', 'car_id'];

    //rezerwacja nalezy do jakiegos usera
    public function user()
    {
        return $this->belongsTo('User');
    }

    //rezerwacja dotyczy jakiegos auta
    public function car()
    {
        return $this->belongsTo('Car');
    }

    //rezerwacja dotyczy jakiegos miasta
    public function city()
    {
        return $this->belongsTo('City');
    }

}
