<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $fillable = ['model', 'brand', 'type', 'engine', 'fuel_type', 'color', 'power', 'price', 'status', 'city_id'];

    //samochod nalezy do jakiegos miasta
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    //samochod moze posiadac 1 lub wiele rezerwacji
    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    //relacja z Photo: 1 do wielu (relacja polimorficzna)
    //auto moze miec 1 lub wiele zdjec
    public function photos()
    {
        return $this->morphMany('App\Models\Photo', 'photoable');
    }


}
