<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $fillable = ['name'];

    //dane miasto posiada 1 lub wiele aut
    public function cars()
    {
        return $this->hasMany('Car');
    }

    //dane miasto posiada 1 lub wiele rezerwacji
    public function reservations()
    {
        return $this->hasMany('Reservation');
    }

}
